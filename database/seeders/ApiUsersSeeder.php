<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use App\Models\User;


class ApiUsersSeeder extends Seeder
{
    public function run(): void
    {
        $response = Http::get(env('API_URL'));

        

        $data = $response->json();
        if (is_string($data)) {
            $data = json_decode($data, true);
        }
        
        $usersData = $data['users'];
        
        foreach ($usersData as $userData) {
            User::create([
                'user_id' => $userData['id'],
                'username' => $userData['username'],
                'full_name' => $userData['full_name'],
                'role' => $userData['role'],
                'active' => $userData['active'],
            ]);
        }

        
    }
}
