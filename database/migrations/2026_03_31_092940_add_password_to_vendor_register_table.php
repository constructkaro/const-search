<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (! Schema::hasTable('vendor_register') || Schema::hasColumn('vendor_register', 'password')) {
            return;
        }

        Schema::table('vendor_register', function (Blueprint $table) {
            $table->string('password')->nullable()->after('business_entity');
        });
    }

    public function down(): void
    {
        if (! Schema::hasTable('vendor_register') || ! Schema::hasColumn('vendor_register', 'password')) {
            return;
        }

        Schema::table('vendor_register', function (Blueprint $table) {
            $table->dropColumn('password');
        });
    }
};
