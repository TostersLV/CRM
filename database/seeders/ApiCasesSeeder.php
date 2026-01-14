<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Carbon;
use App\Models\Cases as CasesModel;
use App\Models\RiskFlags;


class ApiCasesSeeder extends Seeder
{
    public function run(): void
    {
        $response = Http::get(env('API_URL'));

        $data = $response->json();
        if (is_string($data)) {
            $data = json_decode($data, true);
        }

        $CasesData = $data['cases'];

        $CasesData = array_map(function ($caseData) {
        if (isset($caseData['arrival_ts'])) {
            $caseData['arrival_ts'] = Carbon::parse($caseData['arrival_ts'])
                ->setTimezone('UTC')
                ->toDateTimeString();
        } 
            return $caseData;
        }, $CasesData);
            


        foreach ($CasesData as $caseData) {
             

            // Create case record
            $case = CasesModel::create([
                'case_id' => $caseData['id'],
                'external_ref' => $caseData['external_ref'],
                'status' => $caseData['status'],
                'priority' => $caseData['priority'] ,
                'arrival_ts' => $caseData['arrival_ts'],
                'checkpoint_id' => $caseData['checkpoint_id'],
                'origin_country' => $caseData['origin_country'],
                'destination_country' => $caseData['destination_country'],
                
                'declerant_id' => $caseData['declarant_id'],
                'consignee_id' => $caseData['consignee_id'],
                'vehicle_id' => $caseData['vehicle_id'],
            ]); 

            // Create related risk flags
            foreach ($caseData['risk_flags'] ?? [] as $flag) {
                RiskFlags::create([
                    'case_id' => $case->id,
                    'flag' => $flag,
                ]);
            
            }
        }

        $this->command->info('✅ Cases and risk flags imported successfully!');
    }
}
