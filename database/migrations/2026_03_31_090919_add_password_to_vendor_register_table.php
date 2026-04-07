<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('vendor_register', function (Blueprint $table) {
            $table->string('password')->nullable()->after('business_entity');
            $table->tinyInteger('is_password_set')->default(0)->after('password');
        });
    }

    public function down(): void
    {
        Schema::table('vendor_register', function (Blueprint $table) {
            $table->dropColumn(['password', 'is_password_set']);
        });
    }
};
