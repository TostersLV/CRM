<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;

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
           User::firstOrCreate([
                'user_id' => $userData['id'],
                'username' => $userData['username'],
                'full_name' => $userData['full_name'],
                'role' => $userData['role'],
                'active' => $userData['active'],
            ]);
            $duplicateNames = User::select('full_name')
            ->groupBy('full_name')
            ->havingRaw('count(*) > 1')
            ->pluck('full_name');

        foreach ($duplicateNames as $fullName) {
            User::where('full_name', $fullName)
                ->orderBy('id')
                ->skip(1)
                ->delete();
        }
            
        }

        
    }
}
