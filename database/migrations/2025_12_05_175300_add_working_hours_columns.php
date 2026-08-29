<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('restaurant_working_hours', function (Blueprint $table) {
            if (!Schema::hasColumn('restaurant_working_hours', 'day_of_week')) {
                $table->string('day_of_week')->nullable()->after('id');
            }
            if (!Schema::hasColumn('restaurant_working_hours', 'opens_at')) {
                $table->time('opens_at')->nullable()->after('day_of_week');
            }
            if (!Schema::hasColumn('restaurant_working_hours', 'closes_at')) {
                $table->time('closes_at')->nullable()->after('opens_at');
            }
            if (!Schema::hasColumn('restaurant_working_hours', 'is_closed')) {
                $table->boolean('is_closed')->default(false)->after('closes_at');
            }
        });
    }

    public function down(): void
    {
        Schema::table('restaurant_working_hours', function (Blueprint $table) {
            if (Schema::hasColumn('restaurant_working_hours', 'day_of_week')) {
                $table->dropColumn('day_of_week');
            }
            if (Schema::hasColumn('restaurant_working_hours', 'opens_at')) {
                $table->dropColumn('opens_at');
            }
            if (Schema::hasColumn('restaurant_working_hours', 'closes_at')) {
                $table->dropColumn('closes_at');
            }
            if (Schema::hasColumn('restaurant_working_hours', 'is_closed')) {
                $table->dropColumn('is_closed');
            }
        });
    }
};
