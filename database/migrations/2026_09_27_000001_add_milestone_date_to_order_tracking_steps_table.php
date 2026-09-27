<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('order_tracking_steps') && ! Schema::hasColumn('order_tracking_steps', 'milestone_date')) {
            Schema::table('order_tracking_steps', function (Blueprint $table) {
                $table->date('milestone_date')->nullable()->after('step_description');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('order_tracking_steps') && Schema::hasColumn('order_tracking_steps', 'milestone_date')) {
            Schema::table('order_tracking_steps', function (Blueprint $table) {
                $table->dropColumn('milestone_date');
            });
        }
    }
};
