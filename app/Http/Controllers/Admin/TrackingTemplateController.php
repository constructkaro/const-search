<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OrderTracking;
use App\Models\OrderTrackingStep;
use App\Models\TrackingTemplate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use ZipArchive;

class TrackingTemplateController extends Controller
{
    public function index(Request $request)
    {
        $query = TrackingTemplate::query();

        if ($request->filled('service_key')) {
            $query->where('service_key', $request->service_key);
        }

        if ($request->filled('tab_type')) {
            $query->where('tab_type', $request->tab_type);
        }

        if ($request->filled('template_code')) {
            $query->where('template_code', $request->template_code);
        }

        $templates = $query
            ->orderBy('service_key')
            ->orderBy('template_code')
            ->orderBy('tab_type')
            ->orderBy('step_order')
            ->get();

        $serviceOptions = [
            'project'    => 'Project',
            'survey'     => 'Survey',
            'testing'    => 'Testing',
            'boq'        => 'BOQ / Estimation',
            'contractor' => 'Contractor',
            'interior'   => 'Interior',
        ];

        $templateCodes = TrackingTemplate::select('template_code')
            ->whereNotNull('template_code')
            ->distinct()
            ->orderBy('template_code')
            ->pluck('template_code');

        return view('admin.tracking_templates.index', compact(
            'templates',
            'serviceOptions',
            'templateCodes'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'service_key'       => 'required|string',
            'template_code'     => 'required|string|max:100',
            'template_name'     => 'required|string|max:150',
            'tab_type'          => 'required|string',
            'step_order'        => 'required|integer|min:1',
            'step_title'        => 'required|string|max:255',
            'step_description'  => 'nullable|string',
            'step_type'         => 'nullable|string|max:100',
            'status_default'    => 'required|string|max:50',
            'button_text'       => 'nullable|string|max:255',
        ]);

        TrackingTemplate::create($request->only([
            'service_key',
            'template_code',
            'template_name',
            'tab_type',
            'step_order',
            'step_title',
            'step_description',
            'step_type',
            'status_default',
            'button_text',
        ]));

        return redirect()->back()->with('success', 'Tracking template step added successfully.');
    }

    public function update(Request $request, $id)
    {
        $template = TrackingTemplate::findOrFail($id);

        $request->validate([
            'service_key'       => 'required|string',
            'template_code'     => 'required|string|max:100',
            'template_name'     => 'required|string|max:150',
            'tab_type'          => 'required|string',
            'step_order'        => 'required|integer|min:1',
            'step_title'        => 'required|string|max:255',
            'step_description'  => 'nullable|string',
            'step_type'         => 'nullable|string|max:100',
            'status_default'    => 'required|string|max:50',
            'button_text'       => 'nullable|string|max:255',
        ]);

        $template->update($request->only([
            'service_key',
            'template_code',
            'template_name',
            'tab_type',
            'step_order',
            'step_title',
            'step_description',
            'step_type',
            'status_default',
            'button_text',
        ]));

        return redirect()->back()->with('success', 'Tracking template updated successfully.');
    }

    public function delete($id)
    {
        $template = TrackingTemplate::findOrFail($id);
        $template->delete();

        return redirect()->back()->with('success', 'Tracking template deleted successfully.');
    }

    public function adminOrders()
    {
        $projectPosts = DB::table('posts')
            ->leftJoin('city', 'posts.city_id', '=', 'city.id')
            ->select('posts.*', 'city.name as city_name')
            ->get()
            ->map(function ($item) {
                return (object) [
                    'id' => $item->id,
                    'customer_id' => $item->user_id ?? null,
                    'type' => 'Posted Project',
                    'service_key' => 'project',
                    'title' => $item->title ?? 'Project',
                    'location' => collect([
                        $item->area ?? null,
                        $item->city_name ?? null,
                        $item->pincode ?? null,
                    ])->filter()->implode(', ') ?: '-',
                    'created_at' => $item->created_at,
                    'source_table' => 'posts',
                ];
            });

        $surveyBookings = DB::table('survey_bookings')->get()->map(function ($item) {
            return (object) [
                'id' => $item->id,
                'customer_id' => $item->customer_id ?? null,
                'type' => 'Survey Booking',
                'service_key' => 'survey',
                'title' => $item->service_name ?? 'Survey Service',
                'location' => $item->full_address ?? '-',
                'created_at' => $item->created_at,
                'source_table' => 'survey_bookings',
            ];
        });

        $testingEnquiries = DB::table('testing_enquiries')->get()->map(function ($item) {
            $location = collect([
                $item->house_building_name ?? null,
                $item->road_area_colony ?? null,
                $item->city ?? null,
                $item->pincode ?? null,
            ])->filter()->implode(', ');

            return (object) [
                'id' => $item->id,
                'customer_id' => $item->customer_id ?? null,
                'type' => 'Testing Enquiry',
                'service_key' => 'testing',
                'title' => $item->project_name ?? $item->service_name ?? 'Testing Service',
                'location' => $location ?: '-',
                'created_at' => $item->created_at,
                'source_table' => 'testing_enquiries',
            ];
        });

        $boqEnquiries = DB::table('boq_enquiries')->get()->map(function ($item) {
            $location = collect([
                $item->house_building_name ?? null,
                $item->road_area_colony ?? null,
                $item->city ?? null,
                $item->pincode ?? null,
            ])->filter()->implode(', ');

            return (object) [
                'id' => $item->id,
                'customer_id' => $item->customer_id ?? null,
                'type' => 'BOQ Enquiry',
                'service_key' => 'boq',
                'title' => $item->project_name ?? $item->service_name ?? 'BOQ / Estimation',
                'location' => $location ?: '-',
                'created_at' => $item->created_at,
                'source_table' => 'boq_enquiries',
            ];
        });

        $contractorBookings = DB::table('contractor_providers')->get()->map(function ($item) {
            $location = collect([
                $item->house_building_name ?? null,
                $item->road_area_colony ?? null,
                $item->city ?? null,
                $item->pincode ?? null,
            ])->filter()->implode(', ');

            return (object) [
                'id' => $item->id,
                'customer_id' => $item->customer_id ?? null,
                'type' => 'Contractor Booking',
                'service_key' => 'contractor',
                'title' => $item->project_name ?? $item->service_name ?? 'Contractor Service',
                'location' => $location ?: '-',
                'created_at' => $item->created_at,
                'source_table' => 'contractor_providers',
            ];
        });

        $interiorBookings = DB::table('interior_providers')->get()->map(function ($item) {
            $location = collect([
                $item->house_building_name ?? null,
                $item->road_area_colony ?? null,
                $item->city ?? null,
                $item->pincode ?? null,
            ])->filter()->implode(', ');

            return (object) [
                'id' => $item->id,
                'customer_id' => $item->customer_id ?? null,
                'type' => 'Interior Booking',
                'service_key' => 'interior',
                'title' => $item->project_name ?? $item->service_name ?? 'Interior Service',
                'location' => $location ?: '-',
                'created_at' => $item->created_at,
                'source_table' => 'interior_providers',
            ];
        });

        $allOrders = collect()
            ->concat($projectPosts)
            ->concat($surveyBookings)
            ->concat($testingEnquiries)
            ->concat($boqEnquiries)
            ->concat($contractorBookings)
            ->concat($interiorBookings)
            ->sortByDesc('created_at')
            ->values();

        $templateOptions = TrackingTemplate::select('service_key', 'template_code', 'template_name')
            ->whereNotNull('template_code')
            ->whereNotNull('template_name')
            ->distinct()
            ->orderBy('service_key')
            ->orderBy('template_name')
            ->get()
            ->groupBy('service_key');

        $assignedTrackings = OrderTracking::get()->keyBy(function ($item) {
            return $item->service_key . '_' . $item->source_id;
        });

        return view('admin.order_tracking.index', compact('allOrders', 'templateOptions', 'assignedTrackings'));
    }

  public function assignTemplate(Request $request)
{
    $request->validate([
        'service_key'   => 'required|string',
        'source_id'     => 'required|integer',
        'source_table'  => 'required|string',
        'customer_id'   => 'nullable|integer',
        'template_code' => 'nullable|string',
    ]);

    $templateCode = $request->template_code ?: 'manual';
    $existingTracking = \App\Models\OrderTracking::where('service_key', $request->service_key)
        ->where('source_id', $request->source_id)
        ->first();

    $tracking = \App\Models\OrderTracking::updateOrCreate(
        [
            'service_key' => $request->service_key,
            'source_id'   => $request->source_id,
        ],
        [
            'customer_id'   => $request->customer_id,
            'source_table'  => $request->source_table,
            'template_code' => $templateCode,
            'status'        => 'in_progress',
        ]
    );

    if ($templateCode === 'manual') {
        return redirect()->back()->with('success', 'Manual tracking started. You can now add milestones.');
    }

    if ($existingTracking && $existingTracking->template_code === $templateCode) {
        return redirect()->back()->with('success', 'Template already assigned.');
    }

    \App\Models\OrderTrackingStep::where('order_tracking_id', $tracking->id)->delete();

    $templates = \App\Models\TrackingTemplate::where('service_key', $request->service_key)
        ->where('template_code', $templateCode)
        ->orderBy('tab_type')
        ->orderBy('step_order')
        ->get();

    foreach ($templates as $template) {
        \App\Models\OrderTrackingStep::create([
            'order_tracking_id' => $tracking->id,
            'template_id'       => $template->id,
            'service_key'       => $template->service_key,
            'template_code'     => $template->template_code,
            'tab_type'          => $template->tab_type,
            'step_order'        => $template->step_order,
            'step_title'        => $template->step_title,
            'step_description'  => $template->step_description,
            'step_type'         => $template->step_type,
            'status'            => $template->status_default,
            'button_text'       => $template->button_text,
        ]);
    }

    return redirect()->back()->with('success', 'Template assigned successfully.');
}
   

   public function manageSteps($service_key, $source_id)
{
    $tracking = \App\Models\OrderTracking::where('service_key', $service_key)
        ->where('source_id', $source_id)
        ->firstOrFail();

    $steps = \App\Models\OrderTrackingStep::where('order_tracking_id', $tracking->id)
        ->orderByRaw("CASE WHEN tab_type = 'order' THEN 0 WHEN tab_type = 'execution' THEN 1 ELSE 2 END")
        ->orderBy('step_order')
        ->get();

    return view('admin.order_tracking.steps', compact('tracking', 'steps'));
}

public function updateStep(Request $request, $id)
{
    $step = \App\Models\OrderTrackingStep::findOrFail($id);

    $request->validate([
        'tab_type' => 'nullable|in:order,execution',
        'step_order' => 'nullable|integer|min:1',
        'step_title' => 'nullable|string|max:255',
        'step_description' => 'nullable|string',
        'step_type' => 'nullable|string|max:100',
        'status' => 'required|string',
        'progress_percent' => 'nullable|integer|min:0|max:100',
        'input_value' => 'nullable|string',
        'button_text' => 'nullable|string|max:255',
        'attachments' => 'nullable|array',
        'attachments.*' => 'file|mimes:pdf,doc,docx,jpg,jpeg,png,zip|max:10240',
        'sub_points' => 'nullable|array',
        'sub_points.*.title' => 'nullable|string|max:255',
        'sub_points.*.description' => 'nullable|string',
        'sub_points.*.status' => 'nullable|in:pending,completed,locked',
        'sub_points.*.progress_percent' => 'nullable|integer|min:0|max:100',
    ]);

    $extraData = $step->extra_data ?: [];

    if (!empty($extraData['download_file'])) {
        $extraData['attachments'] = array_merge($extraData['attachments'] ?? [], [[
            'path' => $extraData['download_file'],
            'name' => $extraData['download_file_name'] ?? basename($extraData['download_file']),
        ]]);
        unset($extraData['download_file'], $extraData['download_file_name']);
    }

    if ($request->hasFile('attachments')) {
        foreach ($request->file('attachments') as $file) {
            $fileName = time().'_'.uniqid().'_'.preg_replace('/\s+/', '_', $file->getClientOriginalName());
            $extraData['attachments'][] = [
                'path' => $file->storeAs('tracking_attachments', $fileName, 'public'),
                'name' => $file->getClientOriginalName(),
            ];
        }
    }

    if ($request->filled('progress_percent')) {
        $extraData['progress_percent'] = (int) $request->progress_percent;
    } else {
        unset($extraData['progress_percent']);
    }

    $subPoints = $this->normalizeSubPoints($request->input('sub_points', []));
    if (!empty($subPoints)) {
        $extraData['sub_points'] = $subPoints;
    } else {
        unset($extraData['sub_points']);
    }

    $step->update([
        'tab_type' => $request->tab_type ?: $step->tab_type,
        'step_order' => $request->step_order ?: $step->step_order,
        'step_title' => $request->step_title ?: $step->step_title,
        'step_description' => $request->step_description,
        'step_type' => $request->step_type ?: $step->step_type,
        'status' => $request->status,
        'input_value' => $request->input_value,
        'button_text' => $request->button_text,
        'extra_data' => $extraData,
    ]);

    return redirect()->back()->with('success', 'Step updated successfully.');
}

public function storeStep(Request $request, $trackingId)
{
    $tracking = \App\Models\OrderTracking::findOrFail($trackingId);

    $request->validate([
        'tab_type' => 'required|in:order,execution',
        'step_order' => 'required|integer|min:1',
        'step_title' => 'required|string|max:255',
        'step_description' => 'nullable|string',
        'step_type' => 'nullable|string|max:100',
        'status' => 'required|string',
        'progress_percent' => 'nullable|integer|min:0|max:100',
        'input_value' => 'nullable|string',
        'button_text' => 'nullable|string|max:255',
        'attachments' => 'nullable|array',
        'attachments.*' => 'file|mimes:pdf,doc,docx,jpg,jpeg,png,zip|max:10240',
        'sub_points' => 'nullable|array',
        'sub_points.*.title' => 'nullable|string|max:255',
        'sub_points.*.description' => 'nullable|string',
        'sub_points.*.status' => 'nullable|in:pending,completed,locked',
        'sub_points.*.progress_percent' => 'nullable|integer|min:0|max:100',
    ]);

    $extraData = [];

    if ($request->filled('progress_percent')) {
        $extraData['progress_percent'] = (int) $request->progress_percent;
    }

    $subPoints = $this->normalizeSubPoints($request->input('sub_points', []));
    if (!empty($subPoints)) {
        $extraData['sub_points'] = $subPoints;
    }

    if ($request->hasFile('attachments')) {
        foreach ($request->file('attachments') as $file) {
            $fileName = time().'_'.uniqid().'_'.preg_replace('/\s+/', '_', $file->getClientOriginalName());
            $extraData['attachments'][] = [
                'path' => $file->storeAs('tracking_attachments', $fileName, 'public'),
                'name' => $file->getClientOriginalName(),
            ];
        }
    }

    \App\Models\OrderTrackingStep::create([
        'order_tracking_id' => $tracking->id,
        'template_id' => null,
        'service_key' => $tracking->service_key,
        'template_code' => $tracking->template_code,
        'tab_type' => $request->tab_type,
        'step_order' => $request->step_order,
        'step_title' => $request->step_title,
        'step_description' => $request->step_description,
        'step_type' => $request->step_type ?: 'normal',
        'status' => $request->status,
        'button_text' => $request->button_text,
        'input_value' => $request->input_value,
        'extra_data' => $extraData,
    ]);

    return redirect()->back()->with('success', 'Milestone added successfully.');
}

public function importStepsExcel(Request $request, $trackingId)
{
    $tracking = \App\Models\OrderTracking::findOrFail($trackingId);

    $request->validate([
        'milestone_excel' => 'required|file|mimes:xlsx|max:10240',
        'sheet_name' => 'nullable|string|max:150',
        'replace_existing' => 'nullable|boolean',
    ]);

    try {
        $parsed = $this->parseMilestoneExcel(
            $request->file('milestone_excel')->getRealPath(),
            $request->input('sheet_name')
        );
    } catch (\Throwable $e) {
        return redirect()->back()->with('error', $e->getMessage());
    }

    if (empty($parsed['steps'])) {
        return redirect()->back()->with('error', 'No milestones found in the selected Excel sheet.');
    }

    DB::transaction(function () use ($request, $tracking, $parsed) {
        if ($request->boolean('replace_existing', true)) {
            \App\Models\OrderTrackingStep::where('order_tracking_id', $tracking->id)->delete();
        }

        foreach ($parsed['steps'] as $row) {
            $extraData = [];

            if ($row['progress_percent'] !== null) {
                $extraData['progress_percent'] = $row['progress_percent'];
            }

            if (!empty($row['sub_points'])) {
                $extraData['sub_points'] = $row['sub_points'];
            }

            \App\Models\OrderTrackingStep::create([
                'order_tracking_id' => $tracking->id,
                'template_id' => null,
                'service_key' => $tracking->service_key,
                'template_code' => $tracking->template_code,
                'tab_type' => $row['tab_type'],
                'step_order' => $row['step_order'],
                'step_title' => $row['step_title'],
                'step_description' => $row['step_description'],
                'step_type' => $row['step_type'],
                'status' => $row['status'],
                'button_text' => $row['button_text'],
                'input_value' => null,
                'extra_data' => $extraData,
            ]);
        }
    });

    return redirect()->back()->with(
        'success',
        count($parsed['steps']).' milestones imported from '.$parsed['sheet_name'].'. You can edit them below.'
    );
}

public function deleteStep($id)
{
    $step = \App\Models\OrderTrackingStep::findOrFail($id);
    $step->delete();

    return redirect()->back()->with('success', 'Milestone deleted successfully.');
}

private function normalizeSubPoints(mixed $subPoints): array
{
    if (!is_array($subPoints)) {
        return [];
    }

    return collect($subPoints)
        ->map(function ($subPoint) {
            if (!is_array($subPoint)) {
                return null;
            }

            $title = trim((string) ($subPoint['title'] ?? ''));
            $description = trim((string) ($subPoint['description'] ?? ''));
            $status = $subPoint['status'] ?? 'pending';
            $progressPercent = $subPoint['progress_percent'] ?? null;

            if ($title === '' && $description === '') {
                return null;
            }

            if (!in_array($status, ['pending', 'completed', 'locked'], true)) {
                $status = 'pending';
            }

            $normalized = [
                'title' => $title,
                'description' => $description,
                'status' => $status,
            ];

            if ($progressPercent !== null && $progressPercent !== '') {
                $normalized['progress_percent'] = max(0, min(100, (int) $progressPercent));
            }

            return $normalized;
        })
        ->filter()
        ->values()
        ->all();
}

private function parseMilestoneExcel(string $path, ?string $sheetName = null): array
{
    $workbook = $this->readXlsxWorkbook($path);
    $selectedSheet = $this->selectXlsxSheet($workbook['sheets'], $sheetName);
    $rows = $this->readXlsxRows($path, $selectedSheet['target'], $workbook['shared_strings']);
    $steps = $this->milestoneRowsFromSheet($rows);

    return [
        'sheet_name' => $selectedSheet['name'],
        'steps' => $steps,
    ];
}

private function readXlsxWorkbook(string $path): array
{
    $zip = new ZipArchive();

    if ($zip->open($path) !== true) {
        throw new \RuntimeException('Unable to open Excel file.');
    }

    $sharedStrings = $this->readXlsxSharedStrings($zip);
    $workbookXml = $zip->getFromName('xl/workbook.xml');
    $relsXml = $zip->getFromName('xl/_rels/workbook.xml.rels');

    if ($workbookXml === false || $relsXml === false) {
        $zip->close();
        throw new \RuntimeException('Invalid Excel file structure.');
    }

    $workbook = simplexml_load_string($workbookXml);
    $rels = simplexml_load_string($relsXml);
    $relationTargets = [];

    foreach ($rels->Relationship as $relationship) {
        $attrs = $relationship->attributes();
        $relationTargets[(string) $attrs['Id']] = 'xl/'.ltrim((string) $attrs['Target'], '/');
    }

    $workbook->registerXPathNamespace('r', 'http://schemas.openxmlformats.org/officeDocument/2006/relationships');
    $sheets = [];

    foreach ($workbook->sheets->sheet as $sheet) {
        $attrs = $sheet->attributes();
        $relAttrs = $sheet->attributes('http://schemas.openxmlformats.org/officeDocument/2006/relationships');
        $relationId = (string) $relAttrs['id'];

        if (!empty($relationTargets[$relationId])) {
            $sheets[] = [
                'name' => (string) $attrs['name'],
                'target' => $relationTargets[$relationId],
            ];
        }
    }

    $zip->close();

    if (empty($sheets)) {
        throw new \RuntimeException('No sheets found in Excel file.');
    }

    return [
        'sheets' => $sheets,
        'shared_strings' => $sharedStrings,
    ];
}

private function readXlsxSharedStrings(ZipArchive $zip): array
{
    $xml = $zip->getFromName('xl/sharedStrings.xml');

    if ($xml === false) {
        return [];
    }

    $shared = simplexml_load_string($xml);
    $strings = [];

    foreach ($shared->si as $item) {
        $parts = [];

        if (isset($item->t)) {
            $parts[] = (string) $item->t;
        }

        foreach ($item->r as $run) {
            if (isset($run->t)) {
                $parts[] = (string) $run->t;
            }
        }

        $strings[] = implode('', $parts);
    }

    return $strings;
}

private function selectXlsxSheet(array $sheets, ?string $sheetName = null): array
{
    $sheetName = trim((string) $sheetName);

    if ($sheetName === '') {
        return $sheets[0];
    }

    foreach ($sheets as $sheet) {
        if (strcasecmp($sheet['name'], $sheetName) === 0) {
            return $sheet;
        }
    }

    $availableSheets = collect($sheets)->pluck('name')->implode(', ');

    throw new \RuntimeException('Sheet not found. Available sheets: '.$availableSheets);
}

private function readXlsxRows(string $path, string $sheetTarget, array $sharedStrings): array
{
    $zip = new ZipArchive();

    if ($zip->open($path) !== true) {
        throw new \RuntimeException('Unable to open Excel file.');
    }

    $sheetXml = $zip->getFromName($sheetTarget);
    $zip->close();

    if ($sheetXml === false) {
        throw new \RuntimeException('Selected sheet data not found in Excel file.');
    }

    $sheet = simplexml_load_string($sheetXml);
    $rows = [];

    foreach ($sheet->sheetData->row as $row) {
        $rowNumber = (int) $row['r'];
        $values = [];

        foreach ($row->c as $cell) {
            $reference = (string) $cell['r'];
            $column = preg_replace('/\d+/', '', $reference);
            $values[$column] = trim($this->xlsxCellValue($cell, $sharedStrings));
        }

        $rows[$rowNumber] = $values;
    }

    ksort($rows);

    return $rows;
}

private function xlsxCellValue(\SimpleXMLElement $cell, array $sharedStrings): string
{
    $type = (string) $cell['t'];

    if ($type === 'inlineStr') {
        return (string) ($cell->is->t ?? '');
    }

    $value = (string) ($cell->v ?? '');

    if ($type === 's') {
        return $sharedStrings[(int) $value] ?? '';
    }

    return $value;
}

private function milestoneRowsFromSheet(array $rows): array
{
    $tabType = null;
    $steps = [];
    $currentIndex = null;
    $lastStepOrderByTab = [];

    foreach ($rows as $cells) {
        if (empty($cells)) {
            continue;
        }

        if ($this->rowHasExcelSectionHeading($cells, ['order tracking', 'ordertracking'])) {
            $tabType = 'order';
            $currentIndex = null;
            continue;
        }

        if ($this->rowHasExcelSectionHeading($cells, ['project execution', 'projectexecution'])) {
            $tabType = 'execution';
            $currentIndex = null;
            continue;
        }

        if ($tabType === null) {
            continue;
        }

        $stepOrder = $this->integerCell($cells['B'] ?? null);

        if ($stepOrder !== null) {
            if (
                $tabType === 'order'
                && !empty($lastStepOrderByTab['order'])
                && $stepOrder <= $lastStepOrderByTab['order']
                && $this->looksLikeExecutionStepRow($cells)
            ) {
                $tabType = 'execution';
                $currentIndex = null;
            }

            $step = $this->excelMainStepFromRow($cells, $tabType, $stepOrder);

            if ($step === null) {
                continue;
            }

            $steps[] = $step;
            $currentIndex = array_key_last($steps);
            $lastStepOrderByTab[$tabType] = $stepOrder;
            continue;
        }

        if ($currentIndex !== null) {
            $subPoint = $this->excelSubPointFromRow($cells, $tabType);

            if ($subPoint !== null) {
                $steps[$currentIndex]['sub_points'][] = $subPoint;
            }
        }
    }

    return $steps;
}

private function rowHasExcelSectionHeading(array $cells, array $headings): bool
{
    foreach ($cells as $value) {
        $normalized = strtolower(preg_replace('/\s+/', ' ', trim((string) $value)));
        $compact = str_replace(' ', '', $normalized);

        foreach ($headings as $heading) {
            if ($normalized === $heading || $compact === $heading) {
                return true;
            }
        }
    }

    return false;
}

private function excelMainStepFromRow(array $cells, string $tabType, int $stepOrder): ?array
{
    $columnC = trim((string) ($cells['C'] ?? ''));
    $columnD = trim((string) ($cells['D'] ?? ''));
    $columnE = trim((string) ($cells['E'] ?? ''));
    $columnF = trim((string) ($cells['F'] ?? ''));
    $columnG = trim((string) ($cells['G'] ?? ''));

    if ($columnC === '' && $columnD === '') {
        return null;
    }

    $isSubPointLayout = $this->rowHasSubPointColumns($cells);
    $subPoints = [];

    if ($tabType === 'execution' && $columnC !== '' && $columnD !== '') {
        $title = $columnC;
        $description = '';
        $typeValue = '';
        $statusValue = $columnF;
        $subPoints[] = $this->normalizeExcelSubPoint($columnD, $columnE, $columnF);
    } elseif ($tabType === 'order' && $isSubPointLayout) {
        $title = $columnC;
        $description = $columnD;
        $typeValue = '';
        $statusValue = $columnG;
        $subPoints[] = $this->normalizeExcelSubPoint($columnE, $columnF, $this->isExcelStatusValue($columnG) ? $columnG : '');
    } else {
        $title = $columnC !== '' ? $columnC : $columnD;
        $description = $columnC !== '' ? $columnD : $columnE;
        $typeValue = $columnE;
        $statusValue = $this->firstExcelStatusValue($columnG, $columnF, $columnE);
    }

    return [
        'tab_type' => $tabType,
        'step_order' => $stepOrder,
        'step_title' => $title,
        'step_description' => $description,
        'step_type' => $this->excelStepType($typeValue),
        'status' => $this->excelStatus($statusValue),
        'button_text' => $this->excelButtonText($typeValue),
        'progress_percent' => null,
        'sub_points' => array_values(array_filter($subPoints)),
    ];
}

private function excelSubPointFromRow(array $cells, string $tabType): ?array
{
    if ($this->rowHasSubPointColumns($cells)) {
        $title = trim((string) (($cells['E'] ?? '') ?: ($cells['D'] ?? '') ?: ($cells['C'] ?? '')));
        $description = trim((string) (($cells['F'] ?? '') ?: ($cells['E'] ?? '')));
        $status = trim((string) ($cells['G'] ?? ''));

        return $this->normalizeExcelSubPoint($title, $description, $status);
    }

    if ($tabType === 'order') {
        $title = trim((string) (($cells['C'] ?? '') ?: ($cells['D'] ?? '') ?: ($cells['E'] ?? '')));
        $description = trim((string) (($cells['C'] ?? '') !== '' ? ($cells['D'] ?? '') : ($cells['E'] ?? '')));
        $status = $this->firstExcelStatusValue($cells['G'] ?? null, $cells['F'] ?? null, $cells['E'] ?? null) ?? '';

        return $this->normalizeExcelSubPoint($title, $description, $status);
    }

    $title = trim((string) (($cells['D'] ?? '') ?: ($cells['C'] ?? '')));
    $description = trim((string) ($cells['E'] ?? ''));
    $status = $this->firstExcelStatusValue($cells['F'] ?? null, $cells['G'] ?? null) ?? '';

    return $this->normalizeExcelSubPoint($title, $description, $status);
}

private function looksLikeExecutionStepRow(array $cells): bool
{
    $columnC = trim((string) ($cells['C'] ?? ''));
    $columnD = trim((string) ($cells['D'] ?? ''));
    $columnE = trim((string) ($cells['E'] ?? ''));
    $columnF = trim((string) ($cells['F'] ?? ''));

    return $columnC !== '' && $columnD !== '' && $columnE !== '' && $this->isExcelStatusValue($columnF);
}

private function rowHasSubPointColumns(array $cells): bool
{
    $columnE = trim((string) ($cells['E'] ?? ''));
    $columnF = trim((string) ($cells['F'] ?? ''));

    return $columnE !== ''
        && $columnF !== ''
        && !$this->isExcelStepTypeValue($columnE)
        && !$this->isExcelStatusValue($columnF);
}

private function normalizeExcelSubPoint(string $title, string $description, string $status): ?array
{
    if ($title === '' && $description === '') {
        return null;
    }

    return [
        'title' => $title,
        'description' => $description,
        'status' => $this->excelStatus($status),
    ];
}

private function integerCell(mixed $value): ?int
{
    $value = trim((string) $value);

    return preg_match('/^\d+$/', $value) ? (int) $value : null;
}

private function excelStepType(?string $value): string
{
    $normalized = strtolower(trim((string) $value));

    return match (true) {
        str_contains($normalized, 'yes') && str_contains($normalized, 'no') => 'choice',
        str_contains($normalized, 'payment') => 'payment',
        str_contains($normalized, 'download') => 'download',
        str_contains($normalized, 'textarea') => 'textarea',
        default => 'normal',
    };
}

private function excelButtonText(?string $value): ?string
{
    $type = $this->excelStepType($value);

    return match ($type) {
        'choice' => 'Yes / No',
        'payment' => 'Payment',
        'download' => 'Download',
        default => null,
    };
}

private function excelStatus(?string $value): string
{
    $normalized = strtolower(trim((string) $value));

    return match (true) {
        str_contains($normalized, 'complete') || str_contains($normalized, 'done') => 'completed',
        str_contains($normalized, 'lock') || str_contains($normalized, 'upcoming') => 'locked',
        default => 'pending',
    };
}

private function firstExcelStatusValue(?string ...$values): ?string
{
    foreach ($values as $value) {
        if ($this->isExcelStatusValue($value)) {
            return $value;
        }
    }

    return null;
}

private function isExcelStatusValue(?string $value): bool
{
    $normalized = strtolower(trim((string) $value));
    $canonical = preg_replace('/[^a-z]/', '', $normalized);

    return $normalized !== ''
        && in_array($canonical, ['complete', 'completed', 'done', 'pending', 'lock', 'locked', 'upcoming'], true);
}

private function isExcelStepTypeValue(?string $value): bool
{
    $normalized = strtolower(trim((string) $value));

    return $normalized !== ''
        && (
            str_contains($normalized, 'yes')
            || str_contains($normalized, 'no')
            || str_contains($normalized, 'payment')
            || str_contains($normalized, 'download')
            || str_contains($normalized, 'textarea')
        );
}

public function startProjectTracking($postId)
{
    $post = DB::table('posts')->where('id', $postId)->first();

    if (!$post) {
        return redirect()->route('admin.allprojects')->with('error', 'Project not found.');
    }

    \App\Models\OrderTracking::firstOrCreate(
        [
            'service_key' => 'project',
            'source_id' => $post->id,
        ],
        [
            'customer_id' => $post->user_id ?? null,
            'source_table' => 'posts',
            'template_code' => 'manual',
            'status' => 'in_progress',
        ]
    );

    return redirect()
        ->route('admin.order_tracking.steps', ['service_key' => 'project', 'source_id' => $post->id])
        ->with('success', 'Project tracking is ready. Add project-specific milestones here.');
}
}
