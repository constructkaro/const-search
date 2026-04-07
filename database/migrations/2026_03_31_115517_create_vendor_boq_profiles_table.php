<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vendor_boq_profiles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('vendor_id')->nullable();

            $table->json('project_types_handled')->nullable();
            $table->string('boq_turnaround_time')->nullable();

            $table->string('gst_certificate')->nullable();
            $table->string('aadhar_card')->nullable();
            $table->string('company_profile')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vendor_boq_profiles');
    }
};