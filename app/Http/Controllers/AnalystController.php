<?php

namespace App\Http\Controllers;

use App\Models\Cases;
use Illuminate\Http\Request;

class AnalystController extends Controller
{
    public function index(){
        
        $screeningCases = Cases::query()->where('status', 'screening')->with('risk_flags')->orderByDesc('updated_at')->limit(40)->get();
        
        return view('roleviews.analyst', [
            'screeningCases' => $screeningCases,
        ]);
    }
  

    public function screeningCases()
    {
        $cases = Cases::query()->where('status', 'screening')->with('risk_flags')->orderByDesc('updated_at')->limit(50)->get();
        
        return response()->json([
            'cases' => $cases->map(function ($case) {
                return [
                    'case_id' => $case->case_id,
                    'origin_country' => $case->origin_country,
                    'risk_flags' => $case->risk_flags->pluck('flag')->values(),
                ];
            })->values(),
        ]);
    }
    public function update(string $caseId, Request $request){
            $case = Cases::query()->where('case_id', $caseId)->first();
    
            $decision = $request->input('decision');

            if($decision === 'no_risk'){
                $case->status = "on_hold";
                $case->save();
                return back();
            }
            elseif($decision === "risk"){
                $case->status = "in_inspection";
                $case->save();
                return back();
            }
        }
    }
