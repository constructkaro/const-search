<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;

class MobileAppController extends Controller
{
    public function dashboard(Request $request): JsonResponse
    {
        $customer = $this->customerFromRequest($request);

        return response()->json([
            'data' => [
                'customer' => $customer,
                'stats' => [
                    'projects' => $customer ? Post::where('user_id', $customer->id)->count() : 0,
                ],
                'next_actions' => [
                    'post_project_requirement',
                    'view_my_projects',
                ],
            ],
        ]);
    }

    public function profile(Request $request): JsonResponse
    {
        $customer = $this->customerFromRequest($request);

        if (! $customer) {
            return response()->json([
                'status' => false,
                'message' => 'Customer profile not found.',
            ], 404);
        }

        return response()->json([
            'status' => true,
            'data' => [
                'customer' => $this->formatCustomer($customer),
            ],
        ]);
    }

    public function updateProfile(Request $request): JsonResponse
    {
        $this->normalizeProfileRequest($request);

        $validator = Validator::make($request->all(), [
            'customer_id' => ['nullable', 'integer', 'exists:customers,id', 'required_without_all:mobile,email'],
            'mobile' => ['nullable', 'digits:10', 'required_without_all:customer_id,email'],
            'email' => ['nullable', 'email', 'max:255', 'required_without_all:customer_id,mobile'],
            'name' => ['required', 'string', 'max:255'],
            'full_name' => ['nullable', 'string', 'max:255'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first() ?: 'Validation failed.',
                'errors' => $validator->errors(),
            ], 422);
        }

        $customer = $this->customerFromRequest($request);

        if (! $customer) {
            return response()->json([
                'status' => false,
                'message' => 'Customer profile not found.',
            ], 404);
        }

        $customer->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Profile updated successfully.',
            'data' => [
                'customer' => $this->formatCustomer($customer->fresh()),
            ],
        ]);
    }

    public function metadata(): JsonResponse
    {
        return response()->json([
            'data' => [
                'services' => $this->tableRows('services', ['id', 'name']),
                'work_types' => $this->tableRows('work_types', ['id', 'work_type']),
                'cities' => $this->tableRows('city', ['id', 'name']),
                'areas' => $this->tableRows('areas', ['id', 'city_id', 'name', 'pincode']),
                'budget_ranges' => $this->tableRows('budget_range', ['id', 'budget_range']),
                'units' => $this->tableRows('cust_unit', ['id', 'unit']),
                'lead_statuses' => [
                    ['value' => 'timepass', 'label' => 'Timepass'],
                    ['value' => 'exploring', 'label' => 'Exploring'],
                    ['value' => 'serious', 'label' => 'Serious'],
                ],
                'added_by_options' => [
                    ['value' => 'manali', 'label' => 'Manali'],
                    ['value' => 'darshana', 'label' => 'Darshana'],
                    ['value' => 'Sakashi', 'label' => 'Sakshi'],
                ],
            ],
        ]);
    }
    
    public function projectForm(): JsonResponse
    {
        return response()->json([
            'data' => [
                'steps' => [
                    ['step' => 1, 'key' => 'project_info', 'title' => 'Project Info'],
                    ['step' => 2, 'key' => 'documents', 'title' => 'Documents'],
                    ['step' => 3, 'key' => 'description', 'title' => 'Description'],
                    ['step' => 4, 'key' => 'submit', 'title' => 'Submit'],
                ],
                'fields' => [
                    'work_type_id' => ['label' => 'Vendor Type', 'required' => true, 'source' => 'metadata.work_types'],
                    'work_subtype_id' => ['label' => 'Project Type', 'required' => true, 'source' => 'GET /api/v1/customer/project-types/{workType}'],
                    'title' => ['label' => 'Project Title', 'required' => true],
                    'city_id' => ['label' => 'City', 'required' => true, 'source' => 'metadata.cities'],
                    'area_ids' => ['label' => 'Area', 'required' => true, 'source' => 'GET /api/v1/customer/cities/{city}/areas'],
                    'pincode' => ['label' => 'Pincode', 'required' => false, 'source' => 'GET /api/v1/customer/pincodes?area_ids[]=1'],
                    'budget' => ['label' => 'Approx Budget', 'required' => false, 'source' => 'metadata.budget_ranges'],
                    'area' => ['label' => 'Area Size', 'required' => false],
                    'unit' => ['label' => 'Unit', 'required' => false, 'source' => 'metadata.units'],
                    'contact_name' => ['label' => 'Contact Name', 'required' => true],
                    'mobile' => ['label' => 'Mobile', 'required' => true],
                    'email' => ['label' => 'Email', 'required' => false],
                    'add_by' => ['label' => 'Added By', 'required' => false, 'source' => 'metadata.added_by_options'],
                    'files' => ['label' => 'Project Documents', 'required' => false, 'type' => 'multipart files'],
                    'description' => ['label' => 'Project Description', 'required' => false],
                ],
            ],
        ]);
    }

    public function projectTypes(int $workType): JsonResponse
    {
        if (! Schema::hasTable('work_subtypes')) {
            return response()->json(['data' => []]);
        }

        return response()->json([
            'data' => DB::table('work_subtypes')
                ->where('work_type_id', $workType)
                ->orderBy('work_subtype')
                ->get(['id', 'work_type_id', 'work_subtype']),
        ]);
    }

    public function areasByCity(int $city): JsonResponse
    {
        if (! Schema::hasTable('areas')) {
            return response()->json(['data' => []]);
        }

        $columns = $this->availableColumns('areas', ['id', 'city_id', 'name', 'pincode']);

        return response()->json([
            'data' => DB::table('areas')
                ->where('city_id', $city)
                ->orderBy('name')
                ->get($columns),
        ]);
    }

    public function pincodes(Request $request): JsonResponse
    {
        $request->validate([
            'area_ids' => ['required', 'array'],
            'area_ids.*' => ['integer'],
        ]);

        if (! Schema::hasTable('areas') || ! Schema::hasColumn('areas', 'pincode')) {
            return response()->json(['data' => []]);
        }

        return response()->json([
            'data' => DB::table('areas')
                ->whereIn('id', $request->input('area_ids', []))
                ->pluck('pincode')
                ->filter()
                ->unique()
                ->values(),
        ]);
    }

    public function storeProject(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'customer_id' => ['nullable', 'integer', 'exists:customers,id'],
            'title' => ['required', 'string', 'max:255'],
            'work_type_id' => ['required', 'integer'],
            'work_subtype_id' => ['required', 'integer'],
            'city_id' => ['required'],
            'area_ids' => ['nullable', 'array'],
            'pincode' => ['nullable', 'string', 'max:20'],
            'budget' => ['nullable'],
            'contact_name' => ['required', 'string', 'max:255'],
            'mobile' => ['required', 'string', 'max:20'],
            'email' => ['nullable', 'email', 'max:255'],
            'description' => ['nullable', 'string'],
            'area' => ['nullable', 'string', 'max:255'],
            'unit' => ['nullable'],
            'lead_status' => ['nullable', 'in:timepass,exploring,serious'],
            'add_by' => ['nullable', 'string', 'max:255'],
            'contact_time' => ['nullable', 'string', 'max:250'],
            'files' => ['nullable'],
            'files.*' => ['nullable', 'file', 'mimes:jpg,jpeg,png,pdf,doc,docx,xls,xlsx', 'max:10240'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation failed.',
                'errors' => $validator->errors(),
            ], 422);
        }

        $filePath = $this->storeProjectFiles($request);

        $projectId = DB::transaction(function () use ($request, $filePath) {
            $customerId = $request->integer('customer_id') ?: $this->firstOrCreateCustomer($request);

            $data = [
                'user_id' => $customerId,
                'title' => $request->title,
                'work_type_id' => $request->work_type_id,
                'work_subtype_id' => $request->work_subtype_id,
                'area_ids' => json_encode($request->input('area_ids', []) ?: []),
                'city_id' => $request->city_id,
                'pincode' => $request->pincode,
                'budget_id' => $request->input('budget'),
                'contact_name' => $request->contact_name,
                'mobile' => $request->mobile,
                'email' => $request->email,
                'add_by' => $request->add_by,
                'lead_status' => $request->lead_status,
                'description' => $request->description,
                'area' => $request->area,
                'files' => $filePath,
                'contact_time' => $request->contact_time,
                'unit_id' => $request->input('unit'),
                'post_verify' => 0,
                'get_vendor' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ];

            return DB::table('posts')->insertGetId($this->onlyExistingColumns('posts', $data));
        });

        return response()->json([
            'status' => true,
            'message' => 'Project submitted successfully.',
            'data' => [
                'project_id' => $projectId,
                'status' => 'sent_to_backend',
            ],
        ], 201);
    }

    public function projects(Request $request): JsonResponse
    {
        $request->validate([
            'customer_id' => ['required', 'integer', 'exists:customers,id'],
        ]);

        return response()->json([
            'data' => Post::where('user_id', $request->integer('customer_id'))
                ->latest()
                ->get(),
        ]);
    }

    public function vendors(Request $request): JsonResponse
    {
        if (! Schema::hasTable('vendor_register')) {
            return response()->json([
                'data' => [],
                'message' => 'Vendor register table not found.',
            ]);
        }

        $project = $request->filled('project_id')
            ? Post::find($request->integer('project_id'))
            : null;

        $cityId = $request->input('city_id', $project?->city_id);
        $areaIds = $request->input('area_ids', $this->decodeIds($project?->area_ids ?? null));
        $limit = $request->boolean('unlocked') ? 50 : 3;

        $vendors = DB::table('vendor_register')
            ->when($cityId && Schema::hasColumn('vendor_register', 'city_ids'), function ($query) use ($cityId) {
                $query->where('city_ids', 'like', '%"'.$cityId.'"%')
                    ->orWhere('city_ids', 'like', '%'.$cityId.'%');
            })
            ->when(! empty($areaIds) && Schema::hasColumn('vendor_register', 'area_ids'), function ($query) use ($areaIds) {
                $query->where(function ($areaQuery) use ($areaIds) {
                    foreach ((array) $areaIds as $areaId) {
                        $areaQuery->orWhere('area_ids', 'like', '%"'.$areaId.'"%')
                            ->orWhere('area_ids', 'like', '%'.$areaId.'%');
                    }
                });
            })
            ->latest('id')
            ->limit($limit)
            ->get()
            ->map(fn ($vendor) => $this->formatVendor($vendor, $request->boolean('unlocked')));

        return response()->json([
            'data' => $vendors,
            'meta' => [
                'free_profiles_limit' => 3,
                'unlocked' => $request->boolean('unlocked'),
                'payment_required_for_more' => ! $request->boolean('unlocked'),
            ],
        ]);
    }

    public function paymentOptions(): JsonResponse
    {
        return response()->json([
            'data' => [
                [
                    'code' => 'more_vendor_profiles',
                    'title' => 'Unlock more vendor profiles',
                    'amount' => 0,
                    'currency' => 'INR',
                    'gateway' => 'configure_payment_gateway',
                ],
            ],
        ]);
    }

    public function unlockMoreVendorProfiles(Request $request): JsonResponse
    {
        $request->validate([
            'customer_id' => ['required', 'integer', 'exists:customers,id'],
            'project_id' => ['required', 'integer', 'exists:posts,id'],
            'payment_status' => ['required', 'in:success,failed'],
            'payment_reference' => ['nullable', 'string', 'max:255'],
        ]);

        if ($request->payment_status !== 'success') {
            return response()->json([
                'status' => false,
                'message' => 'Payment failed. Please retry payment.',
            ], 422);
        }

        return response()->json([
            'status' => true,
            'message' => 'More vendor profiles unlocked.',
            'data' => [
                'project_id' => $request->integer('project_id'),
                'unlocked' => true,
                'payment_reference' => $request->payment_reference,
            ],
        ]);
    }

    public function vendorDetails(int $vendor): JsonResponse
    {
        if (! Schema::hasTable('vendor_register')) {
            abort(404);
        }

        $row = DB::table('vendor_register')->where('id', $vendor)->first();

        abort_if(! $row, 404);

        return response()->json([
            'data' => $this->formatVendor($row, true),
        ]);
    }

    public function sendEnquiry(Request $request, int $vendor): JsonResponse
    {
        $request->validate([
            'customer_id' => ['required', 'integer', 'exists:customers,id'],
            'project_id' => ['nullable', 'integer', 'exists:posts,id'],
            'type' => ['required', 'in:call,whatsapp,enquiry'],
            'message' => ['nullable', 'string', 'max:2000'],
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Enquiry request captured. Connect customer with vendor.',
            'data' => [
                'vendor_id' => $vendor,
                'customer_id' => $request->integer('customer_id'),
                'project_id' => $request->integer('project_id') ?: null,
                'type' => $request->type,
            ],
        ]);
    }

    private function customerFromRequest(Request $request): ?Customer
    {
        $this->normalizeProfileRequest($request);

        if ($request->filled('customer_id')) {
            return Customer::find($request->integer('customer_id'));
        }

        if ($request->filled('mobile')) {
            return Customer::where('mobile', $request->input('mobile'))->first();
        }

        if ($request->filled('email')) {
            return Customer::where('email', $request->input('email'))->first();
        }

        return null;
    }

    private function normalizeProfileRequest(Request $request): void
    {
        $this->mergeRawJsonPayload($request);

        $aliases = [
            'customer_id' => [
                'customerId',
                'customer',
                'customer_id_text',
                'customerIdText',
                'customer_id_label',
                'customerIdLabel',
                'customer_id_display',
                'customerIdDisplay',
                'display_customer_id',
                'displayCustomerId',
                'customer_code',
                'customerCode',
                'customer id',
                'Customer ID',
                'id',
                'user_id',
                'userId',
            ],
            'mobile' => ['customer_mobile', 'customerMobile', 'phone'],
            'name' => ['full_name', 'fullName', 'customer_name', 'customerName'],
            'email' => ['email_address', 'emailAddress'],
        ];

        $normalized = [];

        foreach ($aliases as $field => $fieldAliases) {
            if ($request->filled($field)) {
                continue;
            }

            foreach ($fieldAliases as $alias) {
                if ($request->filled($alias)) {
                    $normalized[$field] = $request->input($alias);
                    break;
                }
            }
        }

        if ($request->filled('customer_id')) {
            $customerId = preg_replace('/\D+/', '', (string) $request->input('customer_id'));

            if ($customerId !== '') {
                $normalized['customer_id'] = (int) $customerId;
            }
        }

        if (! empty($normalized)) {
            $request->merge($normalized);
        }
    }

    private function mergeRawJsonPayload(Request $request): void
    {
        $content = trim($request->getContent());

        if ($content === '' || ! str_starts_with($content, '{')) {
            return;
        }

        $payload = json_decode($content, true);

        if (json_last_error() !== JSON_ERROR_NONE || ! is_array($payload)) {
            return;
        }

        foreach (['data', 'customer', 'profile', 'body'] as $key) {
            if (isset($payload[$key]) && is_array($payload[$key])) {
                $payload = array_merge($payload, $payload[$key]);
            }
        }

        $request->merge($payload);
    }

    private function formatCustomer(?Customer $customer): ?array
    {
        if (! $customer) {
            return null;
        }

        return [
            'id' => $customer->id,
            'name' => $customer->name,
            'full_name' => $customer->name,
            'mobile' => $customer->mobile,
            'email' => $customer->email,
            'joined_on' => optional($customer->created_at)->format('d M Y'),
            'account_status' => 'Active',
            'created_at' => $customer->created_at,
            'updated_at' => $customer->updated_at,
        ];
    }

    private function tableRows(string $table, array $columns): array
    {
        if (! Schema::hasTable($table)) {
            return [];
        }

        $availableColumns = $this->availableColumns($table, $columns);

        if (empty($availableColumns)) {
            return [];
        }

        return DB::table($table)->orderBy($availableColumns[0])->get($availableColumns)->all();
    }

    private function availableColumns(string $table, array $columns): array
    {
        return array_values(array_filter(
            $columns,
            fn ($column) => Schema::hasColumn($table, $column)
        ));
    }

    private function firstOrCreateCustomer(Request $request): int
    {
        $customer = DB::table('customers')
            ->where('mobile', $request->mobile)
            ->when($request->filled('email'), function ($query) use ($request) {
                $query->orWhere('email', $request->email);
            })
            ->first();

        if ($customer) {
            $updates = [];

            if (empty($customer->name) && $request->filled('contact_name')) {
                $updates['name'] = $request->contact_name;
            }

            if (empty($customer->email) && $request->filled('email')) {
                $updates['email'] = $request->email;
            }

            if (! empty($updates)) {
                $updates['updated_at'] = now();
                DB::table('customers')->where('id', $customer->id)->update($updates);
            }

            return $customer->id;
        }

        return DB::table('customers')->insertGetId([
            'name' => $request->contact_name,
            'mobile' => $request->mobile,
            'email' => $request->email,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    private function storeProjectFiles(Request $request): ?string
    {
        if (! $request->hasFile('files')) {
            return null;
        }

        $uploadedFiles = $request->file('files');
        $uploadedFiles = is_array($uploadedFiles) ? $uploadedFiles : [$uploadedFiles];
        $paths = [];

        foreach ($uploadedFiles as $file) {
            $fileName = time().'_'.preg_replace('/\s+/', '_', $file->getClientOriginalName());
            $paths[] = $file->storeAs('post_files', $fileName, 'public');
        }

        return count($paths) === 1 ? $paths[0] : json_encode($paths);
    }

    private function onlyExistingColumns(string $table, array $data): array
    {
        if (! Schema::hasTable($table)) {
            return $data;
        }

        $columns = Schema::getColumnListing($table);

        return array_intersect_key($data, array_flip($columns));
    }

    private function formatVendor(object $vendor, bool $unlocked): array
    {
        return [
            'id' => $vendor->id,
            'name' => $vendor->full_name ?? $vendor->name ?? null,
            'company_name' => $vendor->company_name ?? null,
            'city_ids' => $this->decodeIds($vendor->city_ids ?? null),
            'area_ids' => $this->decodeIds($vendor->area_ids ?? null),
            'pincode' => $vendor->pincode ?? null,
            'mobile' => $unlocked ? ($vendor->mobile ?? null) : null,
            'email' => $unlocked ? ($vendor->email ?? null) : null,
            'locked' => ! $unlocked,
        ];
    }

    private function decodeIds(mixed $value): array
    {
        if (empty($value)) {
            return [];
        }

        if (is_array($value)) {
            return $value;
        }

        $decoded = json_decode((string) $value, true);

        if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
            return $decoded;
        }

        return array_values(array_filter(array_map('trim', explode(',', (string) $value))));
    }
}
