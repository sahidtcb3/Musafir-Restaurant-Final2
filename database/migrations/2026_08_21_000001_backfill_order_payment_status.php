<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('orders')->where('status_online_pay', 'paid')->update(['payment_status' => 'paid']);
        DB::table('orders')->where('status_online_pay', 'unpaid')->update(['payment_status' => 'unpaid']);
    }

    public function down(): void
    {
        // Payment status is retained because it is the canonical field after migration.
    }
};
