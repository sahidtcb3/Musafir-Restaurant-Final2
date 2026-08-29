<?php
require 'vendor/autoload.php';
$app = require 'bootstrap/app.php';
$kernel = $app->make(\Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\CompanyAddress;

// Check if company address exists, if not create one
$companyAddress = CompanyAddress::first();

if (!$companyAddress) {
    // Create new company address with coordinates for City center market, Lal Dighi, Chattogram
    $companyAddress = CompanyAddress::create([
        'address' => 'City center market, Lal Dighi, Chattogram',
        'latitude' => 22.3475,  // Approximate latitude for Lal Dighi area, Chattogram
        'longitude' => 91.8123, // Approximate longitude for Lal Dighi area, Chattogram
    ]);
    echo "Company address created successfully!\n";
} else {
    // Update existing address with coordinates
    $companyAddress->update([
        'latitude' => 22.3475,  // Approximate latitude for Lal Dighi area, Chattogram
        'longitude' => 91.8123, // Approximate longitude for Lal Dighi area, Chattogram
    ]);
    echo "Company address updated successfully!\n";
}

echo "Address: " . $companyAddress->address . "\n";
echo "Latitude: " . $companyAddress->latitude . "\n";
echo "Longitude: " . $companyAddress->longitude . "\n";
?>

