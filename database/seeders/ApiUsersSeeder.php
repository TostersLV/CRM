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

        if ($response->failed()) {
            $this->command->error('❌ Failed to fetch userData from API');
            return;
        }

        $data = $response->json();
        if (is_string($data)) {
            $data = json_decode($data, true);
        }

        // Support possible wrappers
        $items = $data['users'] ?? $data['data'] ?? $data;

        if (!is_array($items)) {
            $this->command->error('Unexpected API response structure; expected array.');
            $this->command->info('Response type: ' . gettype($data));
            return;
        }

        $this->command->info('Total items in response: ' . count($items));

        // Show a sample item (first non-empty) for inspection
        $first = null;
        foreach ($items as $it) { if ($it) { $first = $it; break; } }
        if ($first !== null) {
            $this->command->info('Sample item keys: ' . implode(', ', array_keys((array)$first)));
            $this->command->info('Sample id value: ' . ($first['id'] ?? '[no id]'));
        }

        // Match id that contains 'usr-' (more flexible)
        $users = array_values(array_filter($items, function ($item) {
            return isset($item['id']) && str_contains($item['id'], 'usr-');
        }));

        $this->command->info('Matched user-like items: ' . count($users));

        if (empty($users)) {
            $this->command->info('No user records found — check id prefix and response wrapper.');
            return;
        }

        foreach ($users as $userData) {
            User::create([
                'user_id' => $userData['id'],
                'username' => $userData['username'],
                'full_name' => $userData['full_name'],
                'role' => $userData['role'],
                'active' => $userData['active'],
            ]);
        }

        $this->command->info('✅ ' . count($users) . ' Users imported successfully!');
    }
}
