<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
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

        $subtypeExists = DB::table('work_subtypes')
            ->where('work_type_id', $workTypeId)
            ->where('work_subtype', 'Complete project package')
            ->exists();

        if (! $subtypeExists) {
            DB::table('work_subtypes')->insert([
                'work_type_id' => $workTypeId,
                'work_subtype' => 'Complete project package',
            ]);
        }
    }

    public function down(): void
    {
        if (! Schema::hasTable('work_types') || ! Schema::hasTable('work_subtypes')) {
            return;
        }

        $workTypeId = DB::table('work_types')
            ->where('work_type', 'All in One Solution')
            ->value('id');

        if (! $workTypeId) {
            return;
        }

        DB::table('work_subtypes')
            ->where('work_type_id', $workTypeId)
            ->where('work_subtype', 'Complete project package')
            ->delete();

        if (! DB::table('work_subtypes')->where('work_type_id', $workTypeId)->exists()) {
            DB::table('work_types')->where('id', $workTypeId)->delete();
        }
    }
};
