<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use App\Models\documents;


class ApiDocumentsSeeder extends Seeder
{
    public function run(): void
    {
        $response = Http::get(env('API_URL') );

        $data = $response->json();
        if(is_string($data)){
            $data = json_decode($data, true);
        }

        
        if ($response->failed()) {
            $this->command->error('❌ Failed to fetch cases from API');
            return;
        }

        foreach ($response->json() as $documentData) {
           
            documents::create([
                
                'case_id' => $documentData['case_id'],
                'filename' => $documentData['filename'],
                'mime_type' => $documentData['mime_type'],
                'category' => $documentData['category'],
                'pages' => $documentData['pages'],
                'uploaded_by' => $documentData['uploaded_by'],
                
            ]);

            
        }

        $this->command->info('✅ Cases and risk flags imported successfully!');
    }
}
