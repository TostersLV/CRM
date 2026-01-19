<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Cases;
use App\Models\Vehicles;
use App\Models\Parties;
use App\Models\Documents;

class BrokerController extends Controller
{
    public function index(Request $request)
    {
        $caseId = trim((string) $request->query('case_id', ''));

        $case = null;
        $vehicle = null;
        $declerant = null;
        $consignee = null;
        $document = null;

        if ($caseId !== '') {
            $case = Cases::query()->where('case_id', $caseId)->first();

            if ($case) {
                $vehicle = Vehicles::query()->where('vehicle_id', $case->vehicle_id)->first();
                $declerant = Parties::query()->where('party_id', $case->declerant_id)->first();
                $consignee = Parties::query()->where('party_id', $case->consignee_id)->first();
                $document = Documents::query()->where('case_id', $case->case_id)->latest()->first();
            }
        }

        return view('roleviews.broker', [
            'searchCaseId' => $caseId,
            'case' => $case,
            'vehicle' => $vehicle,
            'declerant' => $declerant,
            'consignee' => $consignee,
            'document' => $document,
        ]);
    }

    public function sendToScreening(Request $request, string $caseId)
    {
        $case = Cases::query()->where('case_id', $caseId)->first();
        if (!$case) {
            return back()->with('error', 'Case not found.');
        }

        if ($case->status !== 'new') {
            return back()->with('error', "Only 'new' cases can be sent to screening.");
        }

        $case->status = 'screening';
        $case->save();

        return redirect()->route('roleviews.broker', ['case_id' => $case->case_id])->with('success', 'Case sent to screening.');
    }
}
