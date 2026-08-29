<?php

require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\CompanyWorkingHour;

$days = [
    'Monday',
    'Tuesday',
    'Wednesday',
    'Thursday',
    'Friday',
    'Saturday',
    'Sunday',
];

foreach ($days as $day_name) {
    CompanyWorkingHour::updateOrCreate(
        ['day_of_week' => $day_name],
        [
            'opens_at' => '05:00:00',
            'closes_at' => '23:00:00',
            'is_closed' => false,
        ]
    );
    echo "Updated $day_name\n";
}

echo "All company opening hours updated to 5:00 AM - 11:00 PM for Monday-Sunday\n";
