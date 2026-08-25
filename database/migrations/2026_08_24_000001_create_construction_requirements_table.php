<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('construction_requirements')) {
            Schema::table('construction_requirements', function (Blueprint $table) {
                if (! Schema::hasColumn('construction_requirements', 'services')) {
                    $table->json('services')->nullable();
                }

                if (! Schema::hasColumn('construction_requirements', 'planning_timeframe')) {
                    $table->string('planning_timeframe', 100)->nullable();
                }
            });

            return;
        }

        Schema::create('construction_requirements', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('mobile', 20);
            $table->string('email')->nullable();
            $table->string('house_name')->nullable();
            $table->string('area')->nullable();
            $table->string('city', 100)->nullable();
            $table->string('pincode', 20)->nullable();
            $table->json('services')->nullable();
            $table->string('planning_timeframe', 100)->nullable();
            $table->text('project_description')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('construction_requirements');
    }
};
