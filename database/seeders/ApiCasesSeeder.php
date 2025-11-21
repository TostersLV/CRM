<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use App\Models\cases as casesModel;
use App\Models\risk_flags;

class ApiCasesSeeder extends Seeder
{
    public function run(): void
    {
        $response = Http::get(env('API_URL') . '/cases');

        if ($response->failed()) {
            $this->command->error('❌ Failed to fetch cases from API');
            return;
        }

        foreach ($response->json() as $caseData) {
            // Create case record
            $case = casesModel::create([
                'case_id' => $caseData['id'],
                'external_ref' => $caseData['external_ref'],
                'status' => $caseData['status'],
                'priority' => $caseData['priority'],
                'arrival_ts' => $caseData['arrival_ts'],
                'checkpoint_id' => $caseData['checkpoint_id'],
                'origin_country' => $caseData['origin_country'],
                'destination_country' => $caseData['destination_country'],
                'declarant_id' => $caseData['declarant_id'],
                'consignee_id' => $caseData['consignee_id'],
                'vehicle_id' => $caseData['vehicle_id'],
            ]);

            // Create related risk flags
            foreach ($caseData['risk_flags'] ?? [] as $flag) {
                risk_flags::create([
                    'case_id' => $case->id,
                    'flag' => $flag,
                ]);
            }
        }

        $this->command->info('✅ Cases and risk flags imported successfully!');
    }
}
