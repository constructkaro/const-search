<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('vendor_otps', function (Blueprint $table) {
            $table->id();
            $table->string('mobile', 10)->unique();
            $table->string('otp', 6);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vendor_otps');
    }
};