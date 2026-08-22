<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\OrderTracking;
use App\Models\OrderTrackingStep;
use App\Models\Post;
use App\Support\DefaultProjectTrackingSteps;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
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
        $this->ensureAllInOneProjectOptions();

        return response()->json([
            'data' => [
                'services' => $this->optionRows('services', 'name'),
                'work_types' => $this->optionRows('work_types', 'work_type'),
                'cities' => $this->optionRows('city', 'name'),
                'areas' => $this->areaRows(),
                'budget_ranges' => $this->optionRows('budget_range', 'budget_range'),
                'units' => $this->optionRows('cust_unit', 'unit'),
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
                    'files_note' => ['label' => 'Files Note', 'required' => false],
                    'description' => ['label' => 'Project Description', 'required' => false],
                ],
            ],
        ]);
    }

    public function projectTypes(int $workType): JsonResponse
    {
        $this->ensureAllInOneProjectOptions();

        if (! Schema::hasTable('work_subtypes')) {
            return response()->json(['data' => []]);
        }

        return response()->json([
            'data' => DB::table('work_subtypes')
                ->where('work_type_id', $workType)
                ->orderBy('work_subtype')
                ->get(['id', 'work_type_id', 'work_subtype'])
                ->map(fn ($row) => $this->formatOptionRow($row, 'work_subtype', [
                    'work_type_id' => $row->work_type_id,
                    'work_subtype' => $row->work_subtype,
                ])),
        ]);
    }

    public function areasByCity(int $city): JsonResponse
    {
        return response()->json([
            'data' => $this->areaRows($city),
        ]);
    }

    public function pincodes(Request $request): JsonResponse
    {
        $request->validate([
            'area_ids' => ['required', 'array'],
            'area_ids.*' => ['integer'],
        ]);

        return response()->json([
            'data' => $this->pincodesForAreaIds($request->input('area_ids', [])),
        ]);
    }

    public function storeProject(Request $request): JsonResponse
    {
        $this->mergeRawJsonPayload($request);
        $this->normalizeProjectRequest($request);

        $validator = Validator::make($request->all(), [
            'customer_id' => ['nullable', 'string', 'max:50'],
            'title' => ['required', 'string', 'max:255'],
            'work_type_id' => ['required', 'integer'],
            'work_subtype_id' => ['required', 'integer'],
            'city_id' => ['required'],
            'area_ids' => ['required', 'array', 'min:1'],
            'area_ids.*' => ['integer'],
            'pincode' => ['nullable', 'string', 'max:255'],
            'budget' => ['nullable'],
            'contact_name' => ['required', 'string', 'max:255'],
            'mobile' => ['required', 'string', 'max:20'],
            'email' => ['nullable', 'email', 'max:255'],
            'description' => ['nullable', 'string'],
            'area' => ['nullable', 'string', 'max:255'],
            'unit' => ['nullable'],
            'files_note' => ['nullable', 'string', 'max:2000'],
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

        if (! $request->filled('pincode') && ! empty($request->input('area_ids', []))) {
            $request->merge([
                'pincode' => $this->pincodesForAreaIds($request->input('area_ids', []))->implode(', '),
            ]);
        }

        $customer = $this->projectCustomerFromRequest($request);

        if (! $customer) {
            $customer = Customer::firstOrCreate(
                ['mobile' => $this->normalizeMobileNumber($request->input('mobile'))],
                [
                    'name' => $request->input('contact_name'),
                    'email' => $request->input('email'),
                ]
            );
        }

        try {
            $filePath = $this->storeProjectFiles($request);

            $projectId = DB::transaction(function () use ($request, $filePath, $customer) {
                $data = [
                    'user_id' => $customer->id,
                    'title' => $request->title,
                    'work_type_id' => $request->work_type_id,
                    'work_subtype_id' => $request->work_subtype_id,
                    'area_ids' => json_encode($request->input('area_ids', []) ?: []),
                    'city_id' => $request->city_id,
                    'pincode' => $request->pincode,
                    'budget_id' => $this->nullableInteger($request->input('budget')),
                    'contact_name' => $request->contact_name,
                    'mobile' => $request->mobile,
                    'email' => $request->email,
                    'add_by' => $request->filled('add_by') ? $request->input('add_by') : 'mobile_app',
                    'lead_status' => $request->input('lead_status', 'serious'),
                    'description' => $request->description,
                    'area' => $request->area,
                    'files' => $filePath,
                    'files_note' => $request->files_note,
                    'contact_time' => $request->input('contact_time', ''),
                    'unit_id' => $this->nullableInteger($request->input('unit')),
                    'post_verify' => 0,
                    'get_vendor' => 0,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];

                return DB::table('posts')->insertGetId($this->onlyExistingColumns('posts', $data));
            });
        } catch (\Throwable $e) {
            Log::error('Mobile project submit failed', [
                'message' => $e->getMessage(),
                'request' => $request->except(['files']),
            ]);

            return response()->json([
                'status' => false,
                'message' => 'Project submit failed.',
                'error' => $e->getMessage(),
            ], 500);
        }

        return response()->json([
            'status' => true,
            'message' => 'Project submitted successfully.',
            'data' => [
                'project_id' => $projectId,
                'status' => 'sent_to_backend',
                'customer_id' => $customer->id,
                'project' => [
                    'id' => $projectId,
                    'title' => $request->title,
                    'work_type_id' => (int) $request->work_type_id,
                    'work_subtype_id' => (int) $request->work_subtype_id,
                    'city_id' => $request->city_id,
                    'area_ids' => $request->input('area_ids', []) ?: [],
                    'pincode' => $request->pincode,
                    'budget' => $request->input('budget'),
                    'area' => $request->area,
                    'unit' => $request->input('unit'),
                    'contact_name' => $request->contact_name,
                    'mobile' => $request->mobile,
                    'email' => $request->email,
                    'files' => $filePath,
                    'files_note' => $request->files_note,
                    'description' => $request->description,
                ],
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

    public function projectTracking(Request $request, int $project): JsonResponse
    {
        $post = Post::find($project);

        if (! $post) {
            return response()->json([
                'status' => false,
                'message' => 'Project not found.',
            ], 404);
        }

        if ($request->filled('customer_id') && (int) $post->user_id !== $request->integer('customer_id')) {
            return response()->json([
                'status' => false,
                'message' => 'This project does not belong to the customer.',
            ], 403);
        }

        $tracking = OrderTracking::where('service_key', 'project')
            ->where('source_id', $post->id)
            ->first();

        $adminSteps = collect();

        if ($tracking) {
            $adminSteps = OrderTrackingStep::where('order_tracking_id', $tracking->id)
                ->orderBy('tab_type')
                ->orderBy('step_order')
                ->get();
        }

        $includeDefaultSteps = $request->boolean('include_default_steps', true);
        $steps = $includeDefaultSteps
            ? DefaultProjectTrackingSteps::allWithAdminSteps($adminSteps)
            : $adminSteps;

        $formattedSteps = $steps
            ->values()
            ->map(fn ($step, int $index) => $this->formatTrackingStep($step, $index + 1))
            ->values();

        $totalStages = $formattedSteps->count();
        $completedStages = $formattedSteps->where('status_key', 'completed')->count();
        $progressPercent = $totalStages > 0
            ? (int) round($formattedSteps->sum('progress_percent') / $totalStages)
            : 0;
        $currentStage = $formattedSteps->firstWhere('status_key', 'in_progress')
            ?: $formattedSteps->firstWhere('status_key', 'pending')
            ?: $formattedSteps->firstWhere('status_key', 'upcoming')
            ?: $formattedSteps->last();

        return response()->json([
            'status' => true,
            'message' => 'Project tracking fetched successfully.',
            'data' => [
                'project' => [
                    'id' => $post->id,
                    'title' => $post->title,
                    'service_key' => 'project',
                    'service_name' => 'Project',
                    'customer_id' => $post->user_id,
                ],
                'tracking' => [
                    'id' => $tracking?->id,
                    'template_code' => $tracking?->template_code,
                    'status' => $tracking?->status,
                    'has_admin_milestones' => $adminSteps->isNotEmpty(),
                ],
                'summary' => [
                    'title' => $currentStage['title'] ?? 'Project journey',
                    'description' => $currentStage['short_details'] ?? null,
                    'progress_percent' => $progressPercent,
                    'completed_stages' => $completedStages,
                    'total_stages' => $totalStages,
                    'current_stage_id' => $currentStage['id'] ?? null,
                ],
                'tabs' => [
                    'order' => $formattedSteps->where('tab_type', 'order')->values(),
                    'execution' => $formattedSteps->where('tab_type', 'execution')->values(),
                ],
                'stages' => $formattedSteps,
            ],
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
            $mobile = $this->normalizeMobileNumber($request->input('mobile'));

            return Customer::where('mobile', $mobile)
                ->orWhere('mobile', $request->input('mobile'))
                ->first();
        }

        if ($request->filled('email')) {
            return Customer::where('email', $request->input('email'))->first();
        }

        return null;
    }

    private function projectCustomerFromRequest(Request $request): ?Customer
    {
        $this->mergeRawJsonPayload($request);

        $customer = $this->customerFromRememberedLogin($request);

        if ($customer) {
            return $customer;
        }

        $customer = $this->customerFromIdLikeInputs($request, [
            'customer_id',
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
            'login_user_id',
            'loginUserId',
            'user_id',
            'userId',
        ]);

        if ($customer) {
            return $customer;
        }

        $loginMobile = $this->firstFilledInput($request, [
            'login_mobile',
            'loginMobile',
            'customer_mobile',
            'customerMobile',
            'registered_mobile',
            'registeredMobile',
            'auth_mobile',
            'authMobile',
            'mobile',
            'phone',
        ]);

        if ($loginMobile !== null) {
            $mobile = $this->normalizeMobileNumber($loginMobile);

            return Customer::where('mobile', $mobile)
                ->orWhere('mobile', $loginMobile)
                ->first();
        }

        $loginEmail = $this->firstFilledInput($request, [
            'login_email',
            'loginEmail',
            'customer_email',
            'customerEmail',
            'registered_email',
            'registeredEmail',
            'auth_email',
            'authEmail',
            'email',
        ]);

        if ($loginEmail !== null) {
            return Customer::where('email', $loginEmail)->first();
        }

        return null;
    }

    private function customerFromIdLikeInputs(Request $request, array $keys): ?Customer
    {
        foreach ($keys as $key) {
            if (! $request->filled($key)) {
                continue;
            }

            $customerId = $this->customerIdFromValue($request->input($key));

            if ($customerId === null) {
                continue;
            }

            $customer = Customer::find($customerId);

            if ($customer) {
                return $customer;
            }
        }

        return null;
    }

    private function customerIdFromValue(mixed $value): ?int
    {
        if (is_array($value)) {
            foreach (['id', 'customer_id', 'customerId', 'user_id', 'userId'] as $key) {
                if (array_key_exists($key, $value)) {
                    return $this->customerIdFromValue($value[$key]);
                }
            }

            return null;
        }

        $customerId = preg_replace('/\D+/', '', (string) $value);

        return $customerId === '' ? null : (int) $customerId;
    }

    private function customerFromRememberedLogin(Request $request): ?Customer
    {
        $sessionCustomerId = session('customer_id');

        if ($sessionCustomerId) {
            $customer = Customer::find((int) $sessionCustomerId);

            if ($customer) {
                return $customer;
            }
        }

        $cacheCustomerId = Cache::get(
            'api_customer_login:'.sha1($request->ip().'|'.(string) $request->userAgent())
        );

        if ($cacheCustomerId) {
            return Customer::find((int) $cacheCustomerId);
        }

        return null;
    }

    private function firstFilledInput(Request $request, array $keys): mixed
    {
        foreach ($keys as $key) {
            if ($request->filled($key)) {
                return $request->input($key);
            }
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
                'login_user_id',
                'loginUserId',
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
                    if ($field === 'customer_id') {
                        $customerId = $this->customerIdFromValue($request->input($alias));

                        if ($customerId !== null) {
                            $normalized[$field] = $customerId;
                        }
                    } else {
                        $normalized[$field] = $request->input($alias);
                    }

                    break;
                }
            }
        }

        if ($request->filled('customer_id')) {
            $customerId = $this->customerIdFromValue($request->input('customer_id'));

            if ($customerId !== null) {
                $normalized['customer_id'] = $customerId;
            }
        }

        if (! empty($normalized)) {
            $request->merge($normalized);
        }

        if ($request->filled('mobile')) {
            $mobile = $this->normalizeMobileNumber($request->input('mobile'));

            if ($mobile !== '') {
                $request->merge(['mobile' => $mobile]);
            }
        }
    }

    private function normalizeProjectRequest(Request $request): void
    {
        $aliases = [
            'title' => ['project_title', 'projectTitle'],
            'work_type_id' => ['vendor_type_id', 'vendorTypeId', 'vendor_type', 'vendorType'],
            'work_subtype_id' => ['project_type_id', 'projectTypeId', 'project_type', 'projectType'],
            'city_id' => ['cityId', 'city'],
            'pincode' => ['pin_code', 'pinCode'],
            'budget' => ['budget_id', 'budgetId', 'approx_budget', 'approxBudget', 'approx_budget_rs', 'approxBudgetRs'],
            'area' => ['area_size', 'areaSize'],
            'unit' => ['unit_id', 'unitId'],
            'mobile' => ['phone', 'contact_mobile', 'contactMobile'],
            'contact_name' => ['contactName', 'full_name', 'fullName'],
            'files_note' => ['file_note', 'fileNote', 'documents_note', 'documentsNote', 'filesNote'],
            'description' => ['project_description', 'projectDescription'],
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

        if ($request->has('area_ids') && ! is_array($request->input('area_ids'))) {
            $areaIdsInput = trim((string) $request->input('area_ids'));
            $decodedAreaIds = json_decode($areaIdsInput, true);
            $areaIds = is_array($decodedAreaIds)
                ? $decodedAreaIds
                : array_values(array_filter(array_map('trim', explode(',', $areaIdsInput))));

            $normalized['area_ids'] = $areaIds;
        } elseif (! $request->has('area_ids')) {
            if ($request->filled('area_id')) {
                $normalized['area_ids'] = [$request->input('area_id')];
            } elseif ($request->filled('areaId')) {
                $normalized['area_ids'] = [$request->input('areaId')];
            }
        }

        if (! empty($normalized)) {
            $request->merge($normalized);
        }

        $this->normalizeProjectSelectFields($request);

        if ($request->filled('mobile')) {
            $mobile = $this->normalizeMobileNumber($request->input('mobile'));

            if ($mobile !== '') {
                $request->merge(['mobile' => $mobile]);
            }
        }

        $this->normalizeProjectTypeSelections($request);
    }

    private function normalizeProjectSelectFields(Request $request): void
    {
        foreach (['city_id', 'budget', 'unit'] as $field) {
            if (! $request->has($field)) {
                continue;
            }

            $value = $this->selectionValue($request->input($field));

            if ($value === '' || $value === null) {
                $request->merge([$field => null]);
                continue;
            }

            if (is_numeric($value)) {
                $request->merge([$field => (int) $value]);
                continue;
            }

            if ($field === 'budget') {
                $request->merge([$field => $this->budgetIdFromSelection($value)]);
                continue;
            }

            [$table, $labelColumn] = match ($field) {
                'city_id' => ['city', 'name'],
                'budget' => ['budget_range', 'budget_range'],
                default => ['cust_unit', 'unit'],
            };

            $id = $this->idForLabel($table, $labelColumn, $value);

            if ($id !== null) {
                $request->merge([$field => $id]);
            }
        }

        if ($request->has('area_ids')) {
            $areaIds = collect((array) $request->input('area_ids'))
                ->map(fn ($area) => $this->areaIdFromSelection($area))
                ->filter(fn ($areaId) => $areaId !== null && $areaId !== '')
                ->values()
                ->all();

            $request->merge(['area_ids' => $areaIds]);
        }
    }

    private function normalizeProjectTypeSelections(Request $request): void
    {
        $this->ensureAllInOneProjectOptions();

        if ($request->filled('work_type_id')) {
            $workTypeValue = $this->selectionValue($request->input('work_type_id'));

            if (is_numeric($workTypeValue)) {
                $request->merge(['work_type_id' => (int) $workTypeValue]);
            } else {
                $workTypeId = $this->idForLabel('work_types', 'work_type', $workTypeValue);

                if ($workTypeId !== null) {
                    $request->merge(['work_type_id' => $workTypeId]);
                }
            }
        }

        if ($request->filled('work_subtype_id')) {
            $workSubtypeValue = $this->selectionValue($request->input('work_subtype_id'));

            if (is_numeric($workSubtypeValue)) {
                $request->merge(['work_subtype_id' => (int) $workSubtypeValue]);
            } else {
                $workSubtypeId = $this->idForLabel(
                    'work_subtypes',
                    'work_subtype',
                    $workSubtypeValue,
                    $request->filled('work_type_id') && is_numeric($request->input('work_type_id'))
                        ? ['work_type_id' => (int) $request->input('work_type_id')]
                        : []
                );

                if ($workSubtypeId !== null) {
                    $request->merge(['work_subtype_id' => $workSubtypeId]);
                }
            }
        }

        $this->defaultMissingProjectSubtype($request);
    }

    private function defaultMissingProjectSubtype(Request $request): void
    {
        if (! $request->filled('work_type_id') || ! is_numeric($request->input('work_type_id'))) {
            return;
        }

        if ($request->filled('work_subtype_id') && is_numeric($request->input('work_subtype_id'))) {
            return;
        }

        $workTypeId = (int) $request->input('work_type_id');
        $workSubtypeId = null;

        if ($this->isAllInOneWorkType($workTypeId)) {
            $workSubtypeId = $this->idForLabel(
                'work_subtypes',
                'work_subtype',
                'Complete project package',
                ['work_type_id' => $workTypeId]
            );
        }

        $workSubtypeId ??= DB::table('work_subtypes')
            ->where('work_type_id', $workTypeId)
            ->orderBy('id')
            ->value('id');

        if ($workSubtypeId !== null) {
            $request->merge(['work_subtype_id' => (int) $workSubtypeId]);
        }
    }

    private function isAllInOneWorkType(int $workTypeId): bool
    {
        return $this->normalizeLookupLabel(
            DB::table('work_types')->where('id', $workTypeId)->value('work_type')
        ) === 'allinonesolution';
    }

    private function normalizeMobileNumber(mixed $mobile): string
    {
        $digits = preg_replace('/\D+/', '', (string) $mobile);

        if (strlen($digits) > 10) {
            return substr($digits, -10);
        }

        return $digits;
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

    private function optionRows(string $table, string $labelColumn): array
    {
        if (! Schema::hasTable($table) || ! Schema::hasColumn($table, 'id') || ! Schema::hasColumn($table, $labelColumn)) {
            return [];
        }

        return DB::table($table)
            ->orderBy('id')
            ->get(['id', $labelColumn])
            ->map(fn ($row) => $this->formatOptionRow($row, $labelColumn))
            ->all();
    }

    private function formatOptionRow(object $row, string $labelColumn, array $extra = []): array
    {
        $label = $row->{$labelColumn} ?? null;

        return array_merge([
            'id' => $row->id,
            'value' => $row->id,
            'label' => $label,
            'name' => $label,
            $labelColumn => $label,
        ], $extra);
    }

    private function idForLabel(string $table, string $labelColumn, mixed $label, array $where = []): ?int
    {
        if (! Schema::hasTable($table) || ! Schema::hasColumn($table, 'id') || ! Schema::hasColumn($table, $labelColumn)) {
            return null;
        }

        $normalizedLabel = $this->normalizeLookupLabel($label);

        if ($normalizedLabel === '') {
            return null;
        }

        $query = DB::table($table);

        foreach ($where as $column => $value) {
            if (Schema::hasColumn($table, $column)) {
                $query->where($column, $value);
            }
        }

        $rows = $query->get(['id', $labelColumn]);
        $match = $rows->first(function ($row) use ($labelColumn, $normalizedLabel) {
            $rowLabel = $this->normalizeLookupLabel($row->{$labelColumn} ?? '');

            return $rowLabel === $normalizedLabel
                || str_contains($normalizedLabel, $rowLabel)
                || str_contains($rowLabel, $normalizedLabel);
        });

        return $match ? (int) $match->id : null;
    }

    private function areaIdFromSelection(mixed $area): mixed
    {
        $value = $this->selectionValue($area);

        if ($value === '' || $value === null || is_numeric($value)) {
            return $value;
        }

        $areaTable = $this->areaTable();

        if (! Schema::hasTable($areaTable) || ! Schema::hasColumn($areaTable, 'name')) {
            return $value;
        }

        return $this->idForLabel($areaTable, 'name', $value) ?? $value;
    }

    private function budgetIdFromSelection(mixed $budget): ?int
    {
        $budgetId = $this->idForLabel('budget_range', 'budget_range', $budget);

        if ($budgetId !== null) {
            return $budgetId;
        }

        $amount = (int) preg_replace('/\D+/', '', (string) $budget);

        if ($amount <= 0) {
            return null;
        }

        $ranges = DB::table('budget_range')
            ->orderBy('id')
            ->get(['id', 'budget_range']);

        foreach ($ranges as $range) {
            $label = strtolower((string) $range->budget_range);
            $numbers = array_map(
                'intval',
                preg_split('/\D+/', str_replace(',', '', $label), -1, PREG_SPLIT_NO_EMPTY)
            );

            if (str_contains($label, 'under') && ! empty($numbers) && $amount <= max($numbers)) {
                return (int) $range->id;
            }
        }

        return (int) ($ranges->first()->id ?? null);
    }

    private function nullableInteger(mixed $value): ?int
    {
        return is_numeric($value) ? (int) $value : null;
    }

    private function selectionValue(mixed $value): mixed
    {
        if (is_array($value)) {
            foreach (['id', 'value', 'label', 'name', 'work_type', 'work_subtype'] as $key) {
                if (array_key_exists($key, $value) && $value[$key] !== null && $value[$key] !== '') {
                    return $value[$key];
                }
            }

            return reset($value);
        }

        if (is_string($value)) {
            $trimmed = trim($value);
            $decoded = json_decode($trimmed, true);

            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                return $this->selectionValue($decoded);
            }

            return $trimmed;
        }

        return $value;
    }

    private function ensureAllInOneProjectOptions(): void
    {
        if (! Schema::hasTable('work_types') || ! Schema::hasTable('work_subtypes')) {
            return;
        }

        $workTypeId = DB::table('work_types')
            ->where('work_type', 'All in One Solution')
            ->value('id');

        if (! $workTypeId) {
            $workTypeId = DB::table('work_types')->insertGetId([
                'work_type' => 'All in One Solution',
                'icon' => 'bi-boxes',
            ]);
        }

        foreach (['Complete project package', 'Design + BOQ + execution', 'End-to-end consultation'] as $workSubtype) {
            $subtypeExists = DB::table('work_subtypes')
                ->where('work_type_id', $workTypeId)
                ->where('work_subtype', $workSubtype)
                ->exists();

            if (! $subtypeExists) {
                DB::table('work_subtypes')->insert([
                    'work_type_id' => $workTypeId,
                    'work_subtype' => $workSubtype,
                ]);
            }
        }
    }

    private function normalizeLookupLabel(mixed $label): string
    {
        return strtolower(preg_replace('/[^a-z0-9]+/', '', (string) $label));
    }

    private function availableColumns(string $table, array $columns): array
    {
        return array_values(array_filter(
            $columns,
            fn ($column) => Schema::hasColumn($table, $column)
        ));
    }

    private function areaRows(?int $cityId = null): array
    {
        $areaTable = $this->areaTable();

        if (! Schema::hasTable($areaTable)) {
            return [];
        }

        $columns = Schema::getColumnListing($areaTable);

        if (! in_array('id', $columns, true)) {
            return [];
        }

        $query = DB::table($areaTable);

        if (in_array('city_id', $columns, true)) {
            if ($cityId !== null) {
                $query->where('city_id', $cityId);
            }
        } elseif ($cityId !== null && in_array('city', $columns, true)) {
            $cityName = $this->cityNameForId($cityId);

            if ($cityName === null) {
                return [];
            }

            $query->where('city', $cityName);
        } elseif ($cityId !== null) {
            return [];
        }

        $orderColumn = $this->firstAvailableColumn($areaTable, ['name', 'pincode', 'city', 'id']);

        if ($orderColumn !== null) {
            $query->orderBy($orderColumn);
        }

        return $query->get($columns)
            ->map(fn ($area) => $this->formatAreaRow($area, $columns))
            ->all();
    }

    private function formatAreaRow(object $area, array $columns): array
    {
        $cityName = in_array('city', $columns, true) ? ($area->city ?? null) : null;
        $cityId = in_array('city_id', $columns, true) ? ($area->city_id ?? null) : $this->cityIdForName($cityName);
        $name = in_array('name', $columns, true) ? ($area->name ?? null) : null;

        if ($name === null || $name === '') {
            $name = trim(implode(' - ', array_filter([
                $area->pincode ?? null,
                $cityName,
                $area->state ?? null,
            ])));
        }

        return array_filter([
            'id' => $area->id,
            'city_id' => $cityId,
            'name' => $name !== '' ? $name : 'Area #'.$area->id,
            'pincode' => $area->pincode ?? null,
            'city' => $cityName,
            'state' => $area->state ?? null,
        ], fn ($value) => $value !== null);
    }

    private function firstAvailableColumn(string $table, array $columns): ?string
    {
        foreach ($columns as $column) {
            if (Schema::hasColumn($table, $column)) {
                return $column;
            }
        }

        return null;
    }

    private function areaTable(): string
    {
        if (Schema::hasTable('area')) {
            return 'area';
        }

        return Schema::hasTable('areas') ? 'areas' : 'area';
    }

    private function cityNameForId(int $cityId): ?string
    {
        if (! Schema::hasTable('city') || ! Schema::hasColumn('city', 'id') || ! Schema::hasColumn('city', 'name')) {
            return null;
        }

        return DB::table('city')->where('id', $cityId)->value('name');
    }

    private function cityIdForName(?string $cityName): ?int
    {
        if ($cityName === null || $cityName === '') {
            return null;
        }

        if (! Schema::hasTable('city') || ! Schema::hasColumn('city', 'id') || ! Schema::hasColumn('city', 'name')) {
            return null;
        }

        $cityId = DB::table('city')->where('name', $cityName)->value('id');

        return $cityId !== null ? (int) $cityId : null;
    }


    private function pincodesForAreaIds(array $areaIds)
    {
        $areaIds = array_values(array_filter($areaIds));

        if (empty($areaIds)) {
            return collect();
        }

        if (Schema::hasTable('pincodes')) {
            return DB::table('pincodes')
                ->whereIn('area_id', $areaIds)
                ->orderBy('pincode', 'asc')
                ->pluck('pincode')
                ->filter()
                ->unique()
                ->values();
        }

        $areaTable = $this->areaTable();

        if (Schema::hasTable($areaTable) && Schema::hasColumn($areaTable, 'pincode')) {
            return DB::table($areaTable)
                ->whereIn('id', $areaIds)
                ->pluck('pincode')
                ->filter()
                ->unique()
                ->values();
        }

        return collect();
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

    private function formatTrackingStep(object $step, int $fallbackOrder): array
    {
        $statusKey = $this->trackingStatusKey($step->status ?? 'pending');
        $description = $step->step_description ?? null;
        $extraData = is_array($step->extra_data ?? null) ? $step->extra_data : [];

        return [
            'id' => $step->id ?? null,
            'is_default' => ! isset($step->id),
            'tab_type' => $step->tab_type ?? 'order',
            'step_order' => (int) ($step->step_order ?? $fallbackOrder),
            'stage_no' => str_pad((string) ($step->step_order ?? $fallbackOrder), 2, '0', STR_PAD_LEFT),
            'title' => $step->step_title ?? 'Project milestone',
            'short_details' => $description,
            'scope_items' => $this->trackingScopeItems($description),
            'type' => $step->step_type ?? 'normal',
            'status' => $step->status ?? 'pending',
            'status_key' => $statusKey,
            'status_label' => $this->trackingStatusLabel($statusKey),
            'progress_percent' => $this->trackingStepProgress($statusKey, $extraData['progress_percent'] ?? null),
            'button_text' => $step->button_text ?? null,
            'current_update' => $step->input_value ?? null,
            'attachments' => $this->trackingAttachments($extraData),
            'created_at' => $step->created_at ?? null,
            'updated_at' => $step->updated_at ?? null,
        ];
    }

    private function trackingStatusKey(?string $status): string
    {
        $normalized = strtolower(trim((string) $status));
        $normalized = str_replace([' ', '-'], '_', $normalized);

        return match ($normalized) {
            'complete', 'completed', 'done', 'approved' => 'completed',
            'inprogress', 'in_progress', 'processing', 'ongoing', 'active' => 'in_progress',
            'upcoming', 'locked' => 'upcoming',
            default => 'pending',
        };
    }

    private function trackingStatusLabel(string $statusKey): string
    {
        return match ($statusKey) {
            'completed' => 'Completed',
            'in_progress' => 'In Progress',
            'upcoming' => 'Upcoming',
            default => 'Pending',
        };
    }

    private function trackingStepProgress(string $statusKey, mixed $adminProgress = null): int
    {
        if ($adminProgress !== null && $adminProgress !== '') {
            return max(0, min(100, (int) $adminProgress));
        }

        return match ($statusKey) {
            'completed' => 100,
            'in_progress' => 50,
            default => 0,
        };
    }

    private function trackingScopeItems(?string $description): array
    {
        if (! $description) {
            return [];
        }

        return collect(preg_split('/[\r\n|]+/', $description))
            ->map(fn ($item) => trim($item, " \t\n\r\0\x0B-"))
            ->filter()
            ->values()
            ->all();
    }

    private function trackingAttachments(mixed $extraData): array
    {
        $extraData = is_array($extraData) ? $extraData : [];
        $attachments = $extraData['attachments'] ?? [];

        if (! empty($extraData['download_file'])) {
            $attachments[] = [
                'path' => $extraData['download_file'],
                'name' => $extraData['download_file_name'] ?? basename($extraData['download_file']),
            ];
        }

        return collect($attachments)
            ->filter(fn ($attachment) => is_array($attachment) && ! empty($attachment['path']))
            ->map(function (array $attachment) {
                return [
                    'name' => $attachment['name'] ?? basename($attachment['path']),
                    'path' => $attachment['path'],
                    'url' => Storage::disk('public')->url($attachment['path']),
                ];
            })
            ->values()
            ->all();
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
