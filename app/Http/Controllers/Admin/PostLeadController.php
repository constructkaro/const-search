<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;

class PostLeadController extends Controller
{
    public function index(Request $request)
    {
        $query = DB::table('posts')
            ->leftJoin('city', 'posts.city_id', '=', 'city.id')
            ->select('posts.*', 'city.name as city_name')
            ->latest('posts.created_at');

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('posts.title', 'like', '%'.$search.'%')
                    ->orWhere('posts.contact_name', 'like', '%'.$search.'%')
                    ->orWhere('posts.mobile', 'like', '%'.$search.'%')
                    ->orWhere('city.name', 'like', '%'.$search.'%');
            });
        }

        $posts = $query->paginate(10)->appends([
            'search' => $request->search,
        ]);

        if ($request->ajax()) {
            return view('admin.project.partials.project_table', compact('posts'))->render();
        }

        // dd($posts);
        return view('admin.project.allprojects', compact('posts'));
    }

    public function create()
    {
        $work_types = DB::table('work_types')->get();
        $states = DB::table('state')->orderBy('name')->get();
        $budget_range = DB::table('budget_range')->get();
        $unit = DB::table('cust_unit')->get();
        $cities = DB::table('city')->orderBy('name', 'asc')->get();

        return view('admin.project.create', compact('work_types', 'states', 'budget_range', 'unit', 'cities'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'contact_name' => 'required|string|max:255',
            'mobile' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'state' => 'nullable|string|max:255',
            'lead_status' => 'nullable|in:timepass,exploring,serious',
            'city_id' => 'nullable|string',
            'area_ids' => 'nullable|array',   // ✅ nullable so it doesn't fail if empty
            'area_ids.*' => 'integer',           // ✅ each item must be integer
            'pincode' => 'nullable|string',
            'description' => 'nullable|string',
            'contact_time' => 'nullable|string|max:250',
            'work_type_id' => 'nullable|integer',
            'work_subtype_id' => 'nullable|integer',
            'budget_id' => 'nullable|integer',
            'unit_id' => 'nullable|integer',
            'files' => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx|max:5120',
            'add_by' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            if ($request->ajax()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validation failed.',
                    'errors' => $validator->errors(),
                ], 422);
            }

            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // ✅ Fix 1: Convert area_ids array → JSON string for DB storage
        $areaIds = $request->area_ids ?? [];
        $areaIdsJson = json_encode($areaIds); // stores as: [1, 2, 3]

        // ✅ Fix 2: Handle pincode — it comes as a comma-separated string from readonly input
        // Just store it as-is (it's already a string like "400701, 400705")
        $pincode = $request->pincode ?? null;

        // ✅ Fix 3: Handle file upload (supports multiple files)
        $filePath = null;
        if ($request->hasFile('files')) {
            $uploadedFiles = $request->file('files');

            // If multiple files, store all paths as JSON
            if (is_array($uploadedFiles)) {
                $paths = [];
                foreach ($uploadedFiles as $file) {
                    $fileName = time().'_'.preg_replace('/\s+/', '_', $file->getClientOriginalName());
                    $paths[] = $file->storeAs('post_files', $fileName, 'public');
                }
                $filePath = json_encode($paths);
            } else {
                // Single file
                $file = $uploadedFiles;
                $fileName = time().'_'.preg_replace('/\s+/', '_', $file->getClientOriginalName());
                $filePath = $file->storeAs('post_files', $fileName, 'public');
            }
        }

        $insertId = DB::transaction(function () use ($request, $areaIdsJson, $pincode, $filePath) {
            $userEmail = $request->email ?: 'lead_'.preg_replace('/\D+/', '', $request->mobile).'@constone.local';
            $hasMobileColumn = Schema::hasColumn('users', 'mobile');

            $user = DB::table('users')
                ->where('email', $userEmail)
                ->when($hasMobileColumn, function ($query) use ($request) {
                    $query->orWhere('mobile', $request->mobile);
                })
                ->first();

            if ($user) {
                $userId = $user->id;
            } else {
                $now = now();

                $userData = [
                    'name' => $request->contact_name,
                    'email' => $userEmail,
                    'password' => Hash::make('123456789'),
                    'created_at' => $now,
                    'updated_at' => $now,
                ];

                if ($hasMobileColumn) {
                    $userData['mobile'] = $request->mobile;
                }

                if (Schema::hasColumn('users', 'role')) {
                    $userData['role'] = 'pending';
                }

                $userId = DB::table('users')->insertGetId($userData);
            }

            return DB::table('posts')->insertGetId([
                'user_id' => $userId,
                'title' => $request->title,
                'work_subtype_id' => $request->work_subtype_id ?: null,
                'work_type_id' => $request->work_type_id ?: null,
                'area_ids' => $areaIdsJson,              // ✅ Fixed: JSON string not array
                'city_id' => $request->city_id,
                'budget_id' => $request->budget ?: null,
                'contact_name' => $request->contact_name,
                'mobile' => $request->mobile,
                'email' => $request->email,
                'add_by' => $request->add_by,
                'lead_status' => $request->lead_status,
                'description' => $request->description,
                'files' => $filePath,
                'contact_time' => $request->contact_time,
                'post_verify' => 0,
                'get_vendor' => 0,
                'pincode' => $pincode,                  // ✅ Already a string from the readonly input
                'unit_id' => $request->unit ?: null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        });

        if ($request->ajax()) {
            return response()->json([
                'status' => true,
                'message' => 'Lead added successfully.',
                'id' => $insertId,
            ], 200);
        }

        return redirect()->route('admin.allprojects')
            ->with('success', 'Lead created successfully!');
    }

    public function show($id)
    {
        $post = DB::table('posts')->where('id', $id)->first();

        if (! $post) {
            return redirect()->route('admin.allprojects')->with('error', 'Lead not found.');
        }

        return view('admin.project.show', compact('post'));
    }

    public function edit($id)
    {
        $post = DB::table('posts')->where('id', $id)->first();

        if (! $post) {
            return redirect()->route('admin.allprojects')->with('error', 'Lead not found.');
        }

        return view('admin.project.edit', compact('post'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'contact_name' => 'required|string|max:255',
            'mobile' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'city' => 'nullable|string|max:250',
            'state' => 'nullable|string|max:255',
            'lead_status' => 'nullable|in:timepass,exploring,serious',
            'region' => 'nullable|string|max:250',
            'pincode' => 'nullable|string|max:20',
            'description' => 'nullable|string',
            'area' => 'nullable|string|max:250',
            'contact_time' => 'nullable|string|max:250',
            'work_type_id' => 'nullable|integer',
            'work_subtype_id' => 'nullable|integer',
            'budget_id' => 'nullable|integer',
            'unit_id' => 'nullable|integer',
            'files' => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx|max:5120',
        ]);

        $post = DB::table('posts')->where('id', $id)->first();

        if (! $post) {
            return redirect()->route('admin.allprojects')->with('error', 'Lead not found.');
        }

        $filePath = $post->files;

        if ($request->hasFile('files')) {
            $file = $request->file('files');
            $fileName = time().'_'.preg_replace('/\s+/', '_', $file->getClientOriginalName());
            $filePath = $file->storeAs('post_files', $fileName, 'public');
        }

        DB::table('posts')->where('id', $id)->update([
            'title' => $request->title,
            'work_type_id' => $request->work_type_id ?: null,
            'work_subtype_id' => $request->work_subtype_id ?: null,
            'budget_id' => $request->budget_id ?: null,
            'contact_name' => $request->contact_name,
            'mobile' => $request->mobile,
            'email' => $request->email,
            'state' => $request->state,
            'region' => $request->region,
            'city' => $request->city,
            'lead_status' => $request->lead_status,
            'pincode' => $request->pincode,
            'description' => $request->description,
            'area' => $request->area,
            'contact_time' => $request->contact_time,
            'unit_id' => $request->unit_id ?: null,
            'files' => $filePath,
            'updated_at' => now(),
        ]);

        return redirect()->route('admin.allprojects')->with('success', 'Lead updated successfully.');
    }

    public function destroy($id)
    {
        $post = DB::table('posts')->where('id', $id)->first();

        if (! $post) {
            return redirect()->route('admin.allprojects')->with('error', 'Lead not found.');
        }

        DB::table('posts')->where('id', $id)->delete();

        return redirect()->route('admin.allprojects')->with('success', 'Lead deleted successfully.');
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'lead_status' => 'required|in:timepass,exploring,serious',
        ]);

        $post = DB::table('posts')->where('id', $id)->first();

        if (! $post) {
            return response()->json([
                'status' => false,
                'message' => 'Lead not found.',
            ], 404);
        }

        DB::table('posts')->where('id', $id)->update([
            'lead_status' => $request->lead_status,
            'updated_at' => now(),
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Lead status updated successfully.',
        ]);
    }

    public function updateDescription(Request $request, $id)
    {
        $request->validate([
            'description' => 'nullable|string',
        ]);

        $post = DB::table('posts')->where('id', $id)->first();

        if (! $post) {
            return response()->json([
                'status' => false,
                'message' => 'Lead not found.',
            ], 404);
        }

        DB::table('posts')->where('id', $id)->update([
            'description' => $request->description,
            'updated_at' => now(),
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Description updated successfully.',
        ]);
    }

    public function showData($id)
    {

        $post = DB::table('posts')->where('id', $id)->first();

        if (! $post) {
            return redirect()->back()->with('error', 'Lead not found.');
        }

        $workTypes = DB::table('work_types')->get();
        // dd($service);
        $engineerDesk = DB::table('engineer_desk')->where('post_id', $id)->first();

        return view('admin.project.showdata', compact('post', 'engineerDesk', 'workTypes'));
    }

    public function saveEngineerData(Request $request, $id)
    {

        $post = DB::table('posts')->where('id', $id)->first();

        if (! $post) {
            return redirect()->back()->with('error', 'Lead not found.');
        }

        $validated = $request->validate([
            'customer_requirement' => 'nullable|string',
            'drawing_boq_option' => 'nullable|in:yes,no',
            'drawing_boq' => 'nullable|string',
            'plot_size' => 'nullable|string|max:255',
            'site_condition' => 'nullable|string',
            'service_type' => 'nullable|string|max:255',

            'project_name' => 'nullable|string|max:255',
            'project_location' => 'nullable|string|max:255',
            'project_budget' => 'nullable|string|max:255',
            'project_requirement' => 'nullable|string|max:255',
            'project_timeline' => 'nullable|string|max:255',
            'project_priority' => 'nullable|string|max:255',
            'lead_structuring' => 'nullable|string|max:255',
        ]);

        $data = [
            'post_id' => $id,
            'owner_name' => 'Manali',

            'customer_requirement' => $validated['customer_requirement'] ?? null,
            'drawing_boq' => ($request->drawing_boq_option === 'yes') ? ($validated['drawing_boq'] ?? null) : null,
            'plot_size' => $validated['plot_size'] ?? null,
            'site_condition' => $validated['site_condition'] ?? null,
            'service_type' => $validated['service_type'] ?? null,

            'project_name' => $validated['project_name'] ?? null,
            'project_location' => $validated['project_location'] ?? null,
            'project_budget' => $validated['project_budget'] ?? null,
            'project_requirement' => $validated['project_requirement'] ?? null,
            'project_timeline' => $validated['project_timeline'] ?? null,
            'project_priority' => $validated['project_priority'] ?? null,
            'lead_structuring' => $validated['lead_structuring'] ?? null,

            'updated_at' => now(),
        ];
        //  dd($data);

        $existing = DB::table('engineer_desk')->where('post_id', $id)->first();

        if ($existing) {
            DB::table('engineer_desk')
                ->where('post_id', $id)
                ->update($data);

            return redirect()
                ->route('admin.post-leads.showdata', $id)
                ->with('success', 'Engineer Desk details updated successfully.');
        }

        $data['created_at'] = now();

        DB::table('engineer_desk')->insert($data);

        return redirect()
            ->route('admin.post-leads.showdata', $id)
            ->with('success', 'Engineer Desk details saved successfully.');
    }

    // public function vendorStrategy()
    // {
    //     $vendorStrategies = DB::table('engineer_desk')
    //         ->leftJoin('posts', 'engineer_desk.post_id', '=', 'posts.id')
    //         ->select(
    //             'engineer_desk.*',
    //             'posts.title',
    //             'posts.contact_name',
    //             'posts.mobile',
    //             'posts.city_id',
    //             'posts.files'
    //         )
    //         ->orderByDesc('engineer_desk.id')
    //         ->paginate(10);
    // dd($vendorStrategies);
    //     return view('admin.project.vendor_strategy', compact('vendorStrategies'));
    // }

    public function vendorStrategy()
    {
        $vendorStrategies = DB::table('engineer_desk')
            ->leftJoin('posts', 'engineer_desk.post_id', '=', 'posts.id')
            ->leftJoinSub(
                DB::table('vendor_notification_responses')
                    ->select('post_id', DB::raw('COUNT(*) as accepted_vendor_count'))
                    ->where('is_interested', 1)
                    ->groupBy('post_id'),
                'accepted_vendors',
                function ($join) {
                    $join->on('accepted_vendors.post_id', '=', 'engineer_desk.post_id');
                }
            )
            ->select(
                'engineer_desk.*',
                'posts.title',
                'posts.contact_name',
                'posts.mobile',
                'posts.city_id',
                'posts.files',
                DB::raw('COALESCE(accepted_vendors.accepted_vendor_count, 0) as accepted_vendor_count')
            )
            ->orderByDesc('engineer_desk.id')
            ->paginate(10);

        return view('admin.project.vendor_strategy', compact('vendorStrategies'));
    }

    public function getVendorsByPost($postId)
    {
        $post = DB::table('posts')->where('id', $postId)->first();

        if (! $post) {
            return response()->json([
                'status' => false,
                'html' => '<div class="alert alert-danger mb-0">Project not found.</div>',
            ]);
        }

        $engineerDesk = DB::table('engineer_desk')->where('post_id', $postId)->first();

        if (! $engineerDesk || empty($engineerDesk->service_type)) {
            return response()->json([
                'status' => false,
                'html' => '<div class="alert alert-warning mb-0">Service type not selected in Engineer Desk.</div>',
            ]);
        }

        $serviceType = trim($engineerDesk->service_type);

        $providerTables = [
            'Architect' => 'architect_providers',
            'Contractor' => 'contractor_providers',
            // 'Consultant' => 'consultant_providers',
            'Testing' => 'testing_lab_agency_providers',
            'Survey' => 'surveyor_providers',
        ];

        if (! isset($providerTables[$serviceType])) {
            return response()->json([
                'status' => false,
                'html' => '<div class="alert alert-warning mb-0">No provider table mapped for service type: '.e($serviceType).'</div>',
            ]);
        }

        $providerTable = $providerTables[$serviceType];
        $providerColumns = Schema::getColumnListing($providerTable);
        $vendorColumns = Schema::getColumnListing('vendor_register');

        $providerColumn = function ($column, $alias = null) use ($providerColumns) {
            $alias = $alias ?: $column;

            if (in_array($column, $providerColumns, true)) {
                return $alias === $column ? 'p.'.$column : 'p.'.$column.' as '.$alias;
            }

            return DB::raw('NULL as '.$alias);
        };

        $vendorColumn = function ($column, $alias = null) use ($vendorColumns) {
            $alias = $alias ?: $column;

            if (in_array($column, $vendorColumns, true)) {
                return $alias === $column ? 'vr.'.$column : 'vr.'.$column.' as '.$alias;
            }

            return DB::raw('NULL as '.$alias);
        };

        if (in_array('project_types', $providerColumns, true)) {
            $projectTypesColumn = 'p.project_types';
        } elseif (in_array('services', $providerColumns, true)) {
            $projectTypesColumn = 'p.services as project_types';
        } else {
            $projectTypesColumn = DB::raw('NULL as project_types');
        }

        $providerDetailColumns = collect($providerColumns)
            ->reject(fn ($column) => in_array($column, ['id', 'vendor_id'], true))
            ->map(fn ($column) => 'p.'.$column.' as provider_'.$column)
            ->all();

        $vendors = DB::table('vendor_register as vr')
            ->join($providerTable.' as p', 'vr.id', '=', 'p.vendor_id')
            ->leftJoin('vendor_project_notifications as vpn', function ($join) use ($postId) {
                $join->on('vr.id', '=', 'vpn.vendor_id')
                    ->where('vpn.post_id', '=', $postId);
            })
            ->select(array_merge([
                'vr.id',
                'vr.full_name',
                'vr.mobile',
                'vr.email',
                'vr.company_name',
                in_array('city', $vendorColumns, true) ? 'vr.city' : DB::raw('NULL as city'),
                in_array('city_ids', $vendorColumns, true) ? 'vr.city_ids as vendor_city_ids' : DB::raw('NULL as vendor_city_ids'),
                $vendorColumn('area_ids', 'vendor_area_ids'),
                $vendorColumn('business_address'),
                $vendorColumn('business_entity'),
                $vendorColumn('pincode', 'vendor_pincode'),
                $vendorColumn('remark'),
                $vendorColumn('created_at', 'vendor_created_at'),
                DB::raw("'".$serviceType."' as service_type"),
                'p.id as provider_id',
                $projectTypesColumn,
                $providerColumn('experience_years'),
                $providerColumn('team_size'),
                $providerColumn('state'),
                $providerColumn('region'),
                $providerColumn('city_id'),
                $providerColumn('city_ids', 'provider_city_ids'),
                $providerColumn('area_ids'),
                'vpn.id as notification_id',
            ], $providerDetailColumns))
            ->get();

        $decodeIds = function ($value) {
            if (empty($value)) {
                return [];
            }

            if (is_array($value)) {
                return $value;
            }

            $decoded = json_decode($value, true);
            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                return $decoded;
            }

            return preg_split('/\s*,\s*/', trim((string) $value, "[] \t\n\r\0\x0B"));
        };

        $cityIds = $vendors
            ->flatMap(function ($vendor) use ($decodeIds) {
                return array_merge(
                    $decodeIds($vendor->provider_city_ids ?? null),
                    $decodeIds($vendor->city_id ?? null),
                    $decodeIds($vendor->vendor_city_ids ?? null)
                );
            })
            ->filter()
            ->unique()
            ->values();

        $cityNames = $cityIds->isNotEmpty()
            ? DB::table('city')->whereIn('id', $cityIds)->pluck('name', 'id')
            : collect();

        $areaIds = $vendors
            ->flatMap(function ($vendor) use ($decodeIds) {
                return array_merge(
                    $decodeIds($vendor->area_ids ?? null),
                    $decodeIds($vendor->vendor_area_ids ?? null)
                );
            })
            ->filter()
            ->unique()
            ->values();

        $areaNames = $areaIds->isNotEmpty()
            ? DB::table('areas')
                ->whereIn('id', $areaIds)
                ->get()
                ->mapWithKeys(function ($area) {
                    $parts = array_filter([$area->pincode ?? null, $area->city ?? null, $area->state ?? null]);

                    return [$area->id => implode(' - ', $parts)];
                })
            : collect();

        $formatValue = function ($value) {
            if ($value === null || $value === '') {
                return null;
            }

            if (is_bool($value)) {
                return $value ? 'Yes' : 'No';
            }

            $decoded = is_string($value) ? json_decode($value, true) : null;
            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                return implode(', ', array_filter($decoded, fn ($item) => $item !== null && $item !== ''));
            }

            return $value;
        };

        $label = fn ($column) => ucwords(str_replace('_', ' ', $column));

        $vendors->transform(function ($vendor) use ($decodeIds, $cityNames, $areaNames, $providerColumns, $formatValue, $label) {
            $ids = $decodeIds($vendor->provider_city_ids ?? null);

            if (empty($ids)) {
                $ids = $decodeIds($vendor->city_id ?? null);
            }

            if (empty($ids)) {
                $ids = $decodeIds($vendor->vendor_city_ids ?? null);
            }

            $names = collect($ids)
                ->map(fn ($id) => $cityNames[$id] ?? null)
                ->filter()
                ->values()
                ->all();

            if (! empty($names)) {
                $vendor->city = implode(', ', $names);
            }

            $areaIds = $decodeIds($vendor->area_ids ?? null);

            if (empty($areaIds)) {
                $areaIds = $decodeIds($vendor->vendor_area_ids ?? null);
            }

            $areaNamesList = collect($areaIds)
                ->map(fn ($id) => $areaNames[$id] ?? null)
                ->filter()
                ->values()
                ->all();

            $vendor->area = ! empty($areaNamesList) ? implode(', ', $areaNamesList) : null;

            $vendor->vendor_details = collect([
                'full_name' => $vendor->full_name ?? null,
                'company_name' => $vendor->company_name ?? null,
                'mobile' => $vendor->mobile ?? null,
                'email' => $vendor->email ?? null,
                'business_entity' => $vendor->business_entity ?? null,
                'business_address' => $vendor->business_address ?? null,
                'city' => $vendor->city ?? null,
                'area' => $vendor->area ?? null,
                'pincode' => $vendor->vendor_pincode ?? null,
                'remark' => $vendor->remark ?? null,
                'registered_on' => $vendor->vendor_created_at ?? null,
            ])
                ->map(fn ($value, $key) => ['label' => $label($key), 'value' => $formatValue($value)])
                ->filter(fn ($detail) => $detail['value'] !== null)
                ->values();

            $vendor->provider_details = collect($providerColumns)
                ->reject(fn ($column) => in_array($column, ['id', 'vendor_id'], true))
                ->map(function ($column) use ($vendor, $formatValue, $label) {
                    $value = $formatValue($vendor->{'provider_'.$column} ?? null);

                    if ($value === null) {
                        return null;
                    }

                    if ($column === 'city_ids' || $column === 'city_id') {
                        $value = $vendor->city ?? $value;
                    }

                    if ($column === 'area_ids') {
                        $value = $vendor->area ?? $value;
                    }

                    return ['label' => $label($column), 'value' => $value];
                })
                ->filter()
                ->values();

            return $vendor;
        });

        $html = view('admin.project.partials.vendor_modal_list', compact('vendors', 'post', 'serviceType'))->render();

        return response()->json([
            'status' => true,
            'html' => $html,
        ]);
    }

    public function assignVendor(Request $request)
    {
        $request->validate([
            'post_id' => 'required|integer',
            'vendor_id' => 'required|integer',
            'service_type' => 'nullable|string|max:255',
        ]);

        $post = DB::table('posts')->where('id', $request->post_id)->first();

        if (! $post) {
            return response()->json([
                'status' => false,
                'message' => 'Project not found.',
            ], 404);
        }

        $alreadyAssigned = DB::table('vendor_project_notifications')
            ->where('post_id', $request->post_id)
            ->where('vendor_id', $request->vendor_id)
            ->first();

        if ($alreadyAssigned) {
            return response()->json([
                'status' => false,
                'message' => 'Vendor already notified for this project.',
            ]);
        }

        $message = 'A new project has been assigned to you. Project: '
            .($post->title ?? 'Project')
            .', Location: '.($post->city ?? '-')
            .', Service: '.($request->service_type ?? '-');

        DB::table('vendor_project_notifications')->insert([
            'post_id' => $request->post_id,
            'vendor_id' => $request->vendor_id,
            'service_type' => $request->service_type,
            'message' => $message,
            'status' => 'unread',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Vendor assigned successfully.',
        ]);
    }
}
