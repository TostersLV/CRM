<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use App\Models\User;


class ApiUsersSeeder extends Seeder
{
    public function run(): void
    {
        $response = Http::get(env('API_URL') . '/users');

        if ($response->failed()) {
            $this->command->error('❌ Failed to fetch userData from API');
            return;
        }

        foreach ($response->json() as $userData) {
            // Create case record
            User::create([
                
                'username' => $userData['username'],
                'full_name' => $userData['full_name'],
                'role' => $userData['role'],
                'active' => $userData['active'],
                
                
            ]);

            
        }

        $this->command->info('✅ Cases and risk flags imported successfully!');
    }
}
