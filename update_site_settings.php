<?php

require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\SiteSetting;

$setting = SiteSetting::first();
if ($setting) {
    $setting->update([
        'country' => 'Bangladesh',
        'currency_symbol' => 'BDT ',
        'currency_code' => 'BDT',
    ]);
    echo "Updated SiteSetting:\n";
    echo "Country: " . $setting->country . "\n";
    echo "Currency Symbol: " . $setting->currency_symbol . "\n";
    echo "Currency Code: " . $setting->currency_code . "\n";
} else {
    echo "No SiteSetting found!\n";
}
