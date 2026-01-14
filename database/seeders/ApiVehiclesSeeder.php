<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use App\Models\Vehicles;


class ApiVehiclesSeeder extends Seeder
{
    public function run(): void
    {
        $response = Http::get(env('API_URL') );

        $data = $response->json();
        if(is_string($data)){
            $data = json_decode($data, true);
        }

        $vehiclesData = $data['vehicles'];

        foreach ($vehiclesData as $vehicleData) {
            // Create case record
            Vehicles::create([
                'vehicle_id' => $vehicleData['id'],
                'plate_no' => $vehicleData['plate_no'],
                'country' => $vehicleData['country'],
                'make' => $vehicleData['make'],
                'model' => $vehicleData['model'],
                'vin' => $vehicleData['vin'],
                
                
            ]);

            
        }

    }
}
