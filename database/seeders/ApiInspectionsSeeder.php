<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Carbon;
use App\Models\Inspections;
use App\Models\Checks;

class ApiInspectionsSeeder extends Seeder
{
    public function run(): void
    {
        $response = Http::get(env('API_URL') );

        $data = $response->json();
        if(is_string($data)){
            $data = json_decode($data, true);
        }

        
        $inspectionsData = $data['inspections'];

        $inspectionsData = array_map(function ($inspectionData) {
        if (isset($inspectionData['start_ts'])) {
            $inspectionData['start_ts'] = Carbon::parse($inspectionData['start_ts'])
                ->setTimezone('UTC')
                ->toDateTimeString();
        }  
            return $inspectionData;
        }, $inspectionsData);   

        foreach ($inspectionsData as $inspectionData) {
            
            $inspection = Inspections::create([
                'inspection_id' => $inspectionData['id'],
                'case_id' => $inspectionData['case_id'],
                'type' => $inspectionData['type'],
                'requested_by' => $inspectionData['requested_by'],
                'start_ts' => $inspectionData['start_ts'],
                'location' => $inspectionData['location'],
                'assigned_to' => $inspectionData['assigned_to'],
            ]);

            
            foreach ($inspectionData['checks'] ?? [] as $check) {
                Checks::create([
                    'inspection_id' => $inspection->id,
                    'name' => $check['name'],
                    'result' => $check['result'],
                ]);
            } 
        }

        
    }
}
