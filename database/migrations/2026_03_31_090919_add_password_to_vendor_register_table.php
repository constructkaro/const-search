<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (! Schema::hasTable('vendor_register')) {
            return;
        }

        Schema::table('vendor_register', function (Blueprint $table) {
            if (! Schema::hasColumn('vendor_register', 'password')) {
                $table->string('password')->nullable()->after('business_entity');
            }

            if (! Schema::hasColumn('vendor_register', 'is_password_set')) {
                $table->tinyInteger('is_password_set')->default(0)->after('password');
            }
        });
    }

    public function down(): void
    {
        if (! Schema::hasTable('vendor_register')) {
            return;
        }

        Schema::table('vendor_register', function (Blueprint $table) {
            if (Schema::hasColumn('vendor_register', 'password')) {
                $table->dropColumn('password');
            }

            if (Schema::hasColumn('vendor_register', 'is_password_set')) {
                $table->dropColumn('is_password_set');
            }
        });
    }
};
