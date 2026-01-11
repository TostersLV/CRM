<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use App\Models\parties;


class ApiPartiesSeeder extends Seeder
{
    public function run(): void
    {
        $response = Http::get(env('API_URL') );

        $data = $response->json();
        if(is_string($data)){
            $data = json_decode($data, true);
        }

        $items = $data['parties'] ?? $data['data'] ?? $data;

        $this->command->info('Total items in response: ' . count($items));

        $partiesData = array_values(array_filter($items, function ($item) {
            return isset($item['id']) && str_contains($item['id'], 'pty-');
        }));

        $this->command->info('Matched user-like items: ' . count($partiesData));

        if ($response->failed()) {
            $this->command->error('❌ Failed to fetch partyData from API');
            return;
        }

        foreach ($partiesData as $partyData) {
            // Create case record
            parties::create([
                'party_id' => $partyData['id'],
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
