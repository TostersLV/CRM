<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cases;
use App\Models\Inspector;

class InspectorController extends Controller
{
    public function index(){
        $inspectionCases = Cases::query()->where('status', 'in_inspection' || 'on_hold')->with('risk_flags')->orderByDesc('updated_at')->limit(40)->get();



        return view('roleviews.inspector', [
            'inspectionCases' => $inspectionCases,
        ]);
    }
}
