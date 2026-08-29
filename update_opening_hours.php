<?php

require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\RestaurantWorkingHour;

$days = [
    1 => 'Monday',
    2 => 'Tuesday',
    3 => 'Wednesday',
    4 => 'Thursday',
    5 => 'Friday',
    6 => 'Saturday',
    0 => 'Sunday',
];

foreach ($days as $day_num => $day_name) {
    RestaurantWorkingHour::updateOrCreate(
        ['day_of_week' => $day_num],
        [
            'working_hours' => '05:00:00 - 23:00:00',
            'opens_at' => '05:00:00',
            'closes_at' => '23:00:00',
            'is_closed' => false,
        ]
    );
    echo "Updated $day_name\n";
}

echo "All opening hours updated to 5:00 AM - 11:00 PM for Monday-Sunday\n";
