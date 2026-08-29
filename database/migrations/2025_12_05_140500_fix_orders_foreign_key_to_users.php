<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // Drop the old foreign key constraint if it exists
            try {
                $table->dropForeign(['customer_id']);
            } catch (\Exception $e) {}

            // Drop the customer_id column
            if (Schema::hasColumn('orders', 'customer_id')) {
                $table->dropColumn('customer_id');
            }

            // Add user_id column with foreign key to users table
            if (!Schema::hasColumn('orders', 'user_id')) {
                $table->unsignedBigInteger('user_id')->nullable()->after('id');
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            }
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // Drop the new foreign key
            try {
                $table->dropForeign(['user_id']);
            } catch (\Exception $e) {}

            if (Schema::hasColumn('orders', 'user_id')) {
                $table->dropColumn('user_id');
            }

            // Restore the old column
            $table->unsignedBigInteger('customer_id')->nullable();
        });
    }
};
