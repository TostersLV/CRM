<x-app-layout>
    

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div>
                    <div class=" ">
                        <p></p>
                    </div>
                </div>
                <div>
                    <div class="mt-4 mx-2 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 ">
                        @if (session('success'))
                            <div class="md:col-span-2 lg:col-span-3 text-green-700">{{ session('success') }}</div>
                        @elseif (session('error'))
                            <div class="md:col-span-2 lg:col-span-3 text-red-700">{{ session('error') }}</div>
                        @endif

                        @foreach($inspectionsCases as $case)
                                <div class="border rounded-lg p-4 bg-gray-50 mb-2">
                                    <div class="flex flex-row justify-between">
                                        <div class="font-semibold">{{ $case->case_id}} </div>
                                        
                                        <div class="border bg-slate-300 rounded-lg">
                                            <div class="p-1 animate-pulse">{{ $case->status }}</div>
                                        </div>
                                    </div>
                                    <div class="mt-1"> <span class="font-medium"></span></div>
                                    <div class="mt-3">
                                        <div class="text-sm font-semibold mb-1"></div>
                                        <div class="flex flex-wrap gap-2">
                                            @if($case->risk_flags && $case->risk_flags->count() > 0)
                                                @foreach ($case->risk_flags as $flag)
                                                    <span class="inline-block text-xs px-2 py-1 rounded bg-red-50 text-red-700 border border-red-200">
                                                        {{ $flag->flag}}
                                                    </span>
                                                     @endforeach
                                                @else
                                                <span class="text-gray-500">none</span>
                                                @endif
                                           
                                        </div>
                                    </div>
                                    <div>
                                    <div class="mt-2 font-semibold">Vehicle info</div>
                                        <div>Plate no: {{ $case->vehicle?->plate_no ?? '-' }}</div>
                                        <div>Make: {{ $case->vehicle?->make ?? '-' }}</div>
                                        <div>VIN: {{ $case->vehicle?->vin ?? '-' }}</div>
                                    </div>
                                    <div class="my-2 border-1 bg-gray-100 rounded-lg">
                                        <div class="border border-black-300 bg-gray-300 rounded-tl-lg rounded-tr-lg">
                                            <div class="font-semibold pl-2">Document info</div>
                                        </div>
                                        <div class="pl-2">
                                            @if ($case->documents && $case->documents->count() > 0)
                                                @foreach ($case->documents as $doc)
                                                    <div>File name: {{ $doc->filename }}</div>
                                                    <div>Pages: {{ $doc->pages }}</div>
                                                @endforeach
                                            @else
                                                <div>File name: -</div>
                                                <div>Pages: -</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="my-2 border-1 bg-gray-100 rounded-lg">
                                        <div class="border-1 bg-gray-300 rounded-tl-lg rounded-tr-lg">
                                            <div class="font-semibold pl-2">Inspection info</div>
                                        </div>
                                        <div class="pl-2">
                                            @php
                                                $inspection = $case->inspections?->first();
                                            @endphp
                                            <div>Check type: {{ $inspection?->type ?? '-' }}</div>
                                            <div>Location of the vehicle: {{ $inspection?->location ?? '-' }}</div>
                                            </div>
                                            <div class="p-2">
                                            <div class="border-1 rounded-lg bg-gray-200 ">
                                                <div class="border-1 rounded-tl-lg rounded-tr-lg bg-gray-300">
                                                    <div class="font-semibold pl-2">What to check</div>
                                                </div>
                                                <div class="pl-2">
                                                    @if ($inspection && $inspection->checks && $inspection->checks->count() > 0)
                                                        @foreach ($inspection->checks as $check)
                                                            <div>Name: {{ $check->name }}</div>
                                                            <div>Result: {{ $check->result }}</div>
                                                        @endforeach
                                                    @else
                                                        <div>Name: -</div>
                                                        <div>Result: -</div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <form action="{{ route('roleview.inspector', $case->case_id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <div class="mt-4 flex gap-2">
                                        <button type="submit" class="px-3 py-1.5 rounded bg-gray-300" name="decision" value="release">Release</button>
                                        <button type="submit" class="px-3 py-1.5 rounded bg-gray-300" name="decision" value="on_hold">Hold</button>
                                        <button type="button" class="px-3 py-1.5 rounded bg-red-300 js-reject" data-case="{{ $case->case_id }}" data-action="{{ route('roleview.inspector', $case->case_id) }}">
                                            Reject
                                        </button>
                                    </div>
                                </form>
                                </div>
                           @endforeach 
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="rejectModal" class="fixed inset-0 z-50 hidden">
        <div id="rejectOverlay" class="absolute inset-0 bg-black/50"></div>
        <div class="relative mx-auto mt-24 w-[92%] max-w-lg rounded-lg bg-white shadow-lg">
            <div class="p-4 border-b flex items-center justify-between">
                <div class="font-semibold">Reject case <span id="rejectCaseId" class="font-mono"></span></div>
                <button id="rejectClose" type="button" class="px-2 py-1 text-sm">close</button>
            </div>

            <form id="rejectForm" method="POST" action="">
                @csrf
                @method('PATCH')
                <input type="hidden" name="decision" value="reject">

                <div class="p-4">
                    <label class="block text-sm font-medium mb-1" for="rejectReason">Reason</label>
                    <textarea
                        id="rejectReason"
                        name="reason"
                        required
                        maxlength="255"
                        class="w-full rounded border-gray-300"
                        rows="4"
                        placeholder="Write why you're rejecting..."
                    ></textarea>
                </div>

                <div class="p-4 border-t flex items-center justify-end gap-2">
                    <button id="rejectCancel" type="button" class="px-4 py-2 rounded bg-gray-200">Cancel</button>
                    <button type="submit" class="px-4 py-2 rounded bg-red-600 text-white">Reject</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const rejectModal = document.getElementById('rejectModal');
        const rejectForm = document.getElementById('rejectForm');
        const rejectCaseId = document.getElementById('rejectCaseId');
        const rejectReason = document.getElementById('rejectReason');

        function showRejectModal(action, caseId) {
            rejectForm.action = action;
            rejectCaseId.textContent = caseId;
            rejectReason.value = '';
            rejectModal.classList.remove('hidden');
            rejectReason.focus();
        }

        function hideRejectModal() {
            rejectModal.classList.add('hidden');
            rejectForm.action = '';
        }

        document.addEventListener('click', (e) => {
            const rejectBtn = e.target.closest('.js-reject');
            if (!rejectBtn) return;

            showRejectModal(rejectBtn.dataset.action, rejectBtn.dataset.case);
        });

        document.getElementById('rejectOverlay').addEventListener('click', hideRejectModal);
        document.getElementById('rejectCancel').addEventListener('click', hideRejectModal);
        document.getElementById('rejectClose').addEventListener('click', hideRejectModal);

        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') hideRejectModal();
        });
    </script>
</x-app-layout>
