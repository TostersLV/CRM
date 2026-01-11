<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use App\Models\vehicles;


class ApiVehiclesSeeder extends Seeder
{
    public function run(): void
    {
        $response = Http::get(env('API_URL') );

        $data = $response->json();
        if(is_string($data)){
            $data = json_decode($data, true);
        }

        $items = $data['vehicles'] ?? $data['data'] ?? $data;

        $this->command->info('Total items in response: ' . count($items));

        $vehiclesData = array_values(array_filter($items, function ($item) {
            return isset($item['id']) && str_contains($item['id'], 'veh-');
        }));

        $this->command->info('Matched user-like items: ' . count($vehiclesData));

        if ($response->failed()) {
            $this->command->error('❌ Failed to fetch partyData from API');
            return;
        }


        foreach ($vehiclesData as $vehicleData) {
            // Create case record
            vehicles::create([
                'vehicle_id' => $vehicleData['id'],
                'plate_no' => $vehicleData['plate_no'],
                'country' => $vehicleData['country'],
                'make' => $vehicleData['make'],
                'model' => $vehicleData['model'],
                'vin' => $vehicleData['vin'],
                
                
            ]);

            
        }

        $this->command->info('✅ vehicleData imported successfully!');
    }
}
