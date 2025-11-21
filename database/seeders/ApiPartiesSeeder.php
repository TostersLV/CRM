<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use App\Models\parties;


class ApiPartiesSeeder extends Seeder
{
    public function run(): void
    {
        $response = Http::get(env('API_URL') . '/parties');

        if ($response->failed()) {
            $this->command->error('❌ Failed to fetch partyData from API');
            return;
        }

        foreach ($response->json() as $partyData) {
            // Create case record
            parties::create([
                
                'type' => $partyData['type'],
                'name' => $partyData['name'],
                'reg_code' => $partyData['reg_code'],
                'vat' => $partyData['vat'],
                'country' => $partyData['country'],
                'email' => $partyData['email'],
                'phone' => $partyData['phone'],
                
            ]);

            
        }

        $this->command->info('✅ Cases and risk flags imported successfully!');
    }
}
