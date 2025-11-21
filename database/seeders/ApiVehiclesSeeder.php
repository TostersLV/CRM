<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use App\Models\vehicles;


class ApiVehiclesSeeder extends Seeder
{
    public function run(): void
    {
        $response = Http::get(env('API_URL') . '/vehicles');

        if ($response->failed()) {
            $this->command->error('❌ Failed to fetch vehicleData from API');
            return;
        }

        foreach ($response->json() as $vehicleData) {
            // Create case record
            vehicles::create([
                
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
