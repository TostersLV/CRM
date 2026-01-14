<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use App\Models\Parties;


class ApiPartiesSeeder extends Seeder
{
    public function run(): void
    {
        $response = Http::get(env('API_URL') );

        $data = $response->json();
        if(is_string($data)){
            $data = json_decode($data, true);
        }

        $partiesData = $data['parties'];


        foreach ($partiesData as $partyData) {
            
            Parties::create([
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

    }
}
