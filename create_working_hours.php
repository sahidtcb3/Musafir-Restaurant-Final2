<?php

require 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;

// Clear existing working hours
DB::table('restaurant_working_hours')->truncate();

// Create working hours for all 7 days: 5 AM to 11 PM
$days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];

foreach ($days as $day) {
    DB::table('restaurant_working_hours')->insert([
        'working_hours' => '5:00 AM - 11:00 PM',
        'day_of_week' => $day,
        'opens_at' => '05:00:00',
        'closes_at' => '23:00:00',
        'is_closed' => 0,
        'created_at' => now(),
        'updated_at' => now(),
    ]);
}

echo "Working hours created successfully!\n";
echo "Monday to Sunday: 5:00 AM to 11:00 PM\n";
