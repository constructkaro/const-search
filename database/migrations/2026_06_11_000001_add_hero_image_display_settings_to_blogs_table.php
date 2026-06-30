<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('blogs', function (Blueprint $table) {
            $table->string('hero_image_fit')->nullable()->after('hero_image');
            $table->string('hero_image_height')->nullable()->after('hero_image_fit');
        });
    }

    public function down(): void
    {
        Schema::table('blogs', function (Blueprint $table) {
            $table->dropColumn(['hero_image_fit', 'hero_image_height']);
        });
    }
};
