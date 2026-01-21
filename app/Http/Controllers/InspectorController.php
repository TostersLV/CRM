<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cases;
use App\Models\Reject_reason;

class InspectorController extends Controller
{
    public function index(){
        $inspectionsCases = Cases::query()
            ->whereIn('status', ['in_inspection', 'on_hold'])
            ->with([
                'risk_flags',
                'vehicle',
                'documents',
                'inspections.checks',
            ])
            ->orderByDesc('updated_at')
            ->limit(40)
            ->get();

        return view('roleviews.inspector', compact('inspectionsCases'));
    }
    public function update(string $caseId, Request $request){
        $case = Cases::query()->where('case_id', $caseId)->first();
        if (!$case) {
            return back()->with('error', 'Case not found.');
        }

        $decision = $request->input('decision');

        if ($decision === 'release') {
            $case->status = 'closed';
            $case->save();
            return back();
        }

        if ($decision === 'on_hold') {
            $case->status = 'on_hold';
            $case->save();
            return back();
        }

        if ($decision === 'reject') {
            $request->validate([
                'reason' => ['required', 'string', 'max:255'],
            ]);

            Reject_reason::create([
                'case_id' => $case->id,
                'reason' => $request->input('reason'),
            ]);

            $case->status = 'screening';
            $case->save();

            return back();
        }

        return back()->with('error', 'Invalid decision.');
        }
}
