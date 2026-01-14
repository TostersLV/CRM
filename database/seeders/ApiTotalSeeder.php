<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use App\Models\Total;

class ApiTotalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $response = Http::get(env('API_URL') );

        $data = $response->json();
        if(is_string($data)){
            $data = json_decode($data, true);
        }

        $totalsData = $data['total'];

        
        
        $totalsData = Total::create([
            
            'vehicles' => $totalsData['vehicles'],
            'parties' => $totalsData['parties'],
            'users' => $totalsData['users'],
            'cases' => $totalsData['cases'],
            'inspections' => $totalsData['inspections'],
            'documents' => $totalsData['documents'],
        ]);

        }

    }

