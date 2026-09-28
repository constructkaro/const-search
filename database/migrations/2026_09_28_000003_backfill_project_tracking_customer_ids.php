<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('order_trackings') || ! Schema::hasTable('posts')) {
            return;
        }

        $customerIdsByPost = DB::table('posts')
            ->whereNotNull('user_id')
            ->pluck('user_id', 'id');

        DB::table('order_trackings')
            ->where('service_key', 'project')
            ->whereNull('customer_id')
            ->orderBy('id')
            ->chunkById(100, function ($trackings) use ($customerIdsByPost) {
                foreach ($trackings as $tracking) {
                    $customerId = $customerIdsByPost->get($tracking->source_id);

                    if ($customerId) {
                        DB::table('order_trackings')
                            ->where('id', $tracking->id)
                            ->update([
                                'customer_id' => $customerId,
                                'updated_at' => now(),
                            ]);
                    }
                }
            });
    }

    public function down(): void
    {
        // This migration repairs ownership data and should not erase it on rollback.
    }
};
