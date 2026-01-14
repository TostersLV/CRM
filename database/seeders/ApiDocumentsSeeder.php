<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use App\Models\Documents;


class ApiDocumentsSeeder extends Seeder
{
    public function run(): void
    {
        $response = Http::get(env('API_URL') );

        $data = $response->json();
        if(is_string($data)){
            $data = json_decode($data, true);
        }   

        $documentsData = $data['documents'];

        foreach ($documentsData as $documentData) {
           
            Documents::create([
                'document_id' => $documentData['id'],
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
