<?php
namespace App\Helpers;

use Illuminate\Support\Facades\Http;

class DistanceHelper
{
    public static function getDistance($originLat, $originLng, $destLat, $destLng)
    {
        // Validate that all coordinates are provided
        if (!$originLat || !$originLng || !$destLat || !$destLng) {
            return [
                'error' => 'Coordinates are required to calculate distance',
            ];
        }

        $apiKey = config('services.google_maps.api_key');

        // If no API key is configured, use a fallback distance calculation
        if (!$apiKey) {
            // Simple Haversine formula for distance calculation
            $distance_miles = self::haversineDistance($originLat, $originLng, $destLat, $destLng);
            
            return [
                'distance'        => round($distance_miles, 2) . ' miles',
                'value_in_miles'  => round($distance_miles, 2),
                'value_in_meters' => round($distance_miles * 1609.344, 2),
            ];
        }

        $origin = "$originLat,$originLng";
        $destination = "$destLat,$destLng";

        try {
            $response = Http::timeout(10)->get('https://maps.googleapis.com/maps/api/distancematrix/json', [
                'origins' => $origin,
                'destinations' => $destination,
                'mode' => 'driving',
                'key' => $apiKey,
            ]);

            $data = $response->json();
      
            if ($response->successful() 
                && isset($data['rows'][0]['elements'][0]['status'])
                && $data['rows'][0]['elements'][0]['status'] === "OK") {

                $meters = $data['rows'][0]['elements'][0]['distance']['value'];
                $miles  = $meters / 1609.344;

                return [
                    'distance'        => round($miles, 2) . ' miles',
                    'value_in_miles'  => round($miles, 2),
                    'value_in_meters' => $meters,
                ];
            }
        } catch (\Exception $e) {
            // Fallback to Haversine if API fails
            $distance_miles = self::haversineDistance($originLat, $originLng, $destLat, $destLng);
            
            return [
                'distance'        => round($distance_miles, 2) . ' miles',
                'value_in_miles'  => round($distance_miles, 2),
                'value_in_meters' => round($distance_miles * 1609.344, 2),
            ];
        }

        return [
            'error' => 'Unable to calculate distance',
        ];
    }

    /**
     * Calculate distance between two coordinates using Haversine formula
     * @param float $lat1 Origin latitude
     * @param float $lon1 Origin longitude
     * @param float $lat2 Destination latitude
     * @param float $lon2 Destination longitude
     * @return float Distance in miles
     */
    private static function haversineDistance($lat1, $lon1, $lat2, $lon2)
    {
        $earth_radius_km = 6371; // Radius of the earth in km
        
        $lat_from = deg2rad($lat1);
        $lon_from = deg2rad($lon1);
        $lat_to = deg2rad($lat2);
        $lon_to = deg2rad($lon2);
        
        $lat_delta = $lat_to - $lat_from;
        $lon_delta = $lon_to - $lon_from;
        
        $angle = 2 * asin(sqrt(pow(sin($lat_delta / 2), 2) +
            cos($lat_from) * cos($lat_to) * pow(sin($lon_delta / 2), 2)));
        
        $distance_km = $angle * $earth_radius_km;
        $distance_miles = $distance_km / 1.60934; // Convert km to miles
        
        return $distance_miles;
    }

}
