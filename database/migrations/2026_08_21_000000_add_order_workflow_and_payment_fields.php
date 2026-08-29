<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (DB::getDriverName() === 'mysql') {
            DB::statement("ALTER TABLE orders MODIFY status VARCHAR(30) NOT NULL DEFAULT 'pending'");
        } elseif (Schema::hasColumn('orders', 'status')) {
            Schema::table('orders', function (Blueprint $table) {
                $table->string('status', 30)->default('pending')->change();
            });
        }

        Schema::table('orders', function (Blueprint $table) {
            if (! Schema::hasColumn('orders', 'payment_status')) {
                $table->string('payment_status', 20)->default('unpaid')->after('payment_method')->index();
            }
            if (! Schema::hasColumn('orders', 'transaction_id')) {
                $table->string('transaction_id')->nullable()->after('payment_status');
            }
            if (! Schema::hasColumn('orders', 'rejection_reason')) {
                $table->text('rejection_reason')->nullable()->after('transaction_id');
            }
            if (! Schema::hasColumn('orders', 'confirmed_at')) {
                $table->timestamp('confirmed_at')->nullable()->after('rejection_reason');
            }
            if (! Schema::hasColumn('orders', 'rejected_at')) {
                $table->timestamp('rejected_at')->nullable()->after('confirmed_at');
            }
            if (! Schema::hasColumn('orders', 'status')) {
                $table->string('status', 30)->default('pending')->index();
            }
        });

        DB::table('orders')->update([
            'payment_status' => DB::raw("CASE WHEN status_online_pay = 'paid' THEN 'paid' ELSE 'unpaid' END"),
        ]);
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $columns = collect(['payment_status', 'transaction_id', 'rejection_reason', 'confirmed_at', 'rejected_at'])
                ->filter(fn ($column) => Schema::hasColumn('orders', $column))
                ->all();

            if ($columns) {
                $table->dropColumn($columns);
            }
        });
    }
};
