<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use App\Models\inspections;
use App\Models\checks;

class ApiInspectionsSeeder extends Seeder
{
    public function run(): void
    {
        $response = Http::get(env('API_URL') . '/inspections');

        if ($response->failed()) {
            $this->command->error('❌ Failed to fetch inspections');
            return;
        }

        foreach ($response->json() as $inspectionData) {
            // Create inspection
            $inspection = inspections::create([
                'inspection_id' => $inspectionData['id'],
                'case_id' => $inspectionData['case_id'],
                'type' => $inspectionData['type'],
                'requested_by' => $inspectionData['requested_by'],
                'start_ts' => $inspectionData['start_ts'],
                'location' => $inspectionData['location'],
                'assigned_to' => $inspectionData['assigned_to'],
            ]);

            // Create related checks
            foreach ($inspectionData['checks'] ?? [] as $check) {
                checks::create([
                    'inspection_id' => $inspection->id,
                    'name' => $check['name'],
                    'result' => $check['result'],
                ]);
            }
        }

        $this->command->info('✅ Inspections imported successfully!');
    }
}
