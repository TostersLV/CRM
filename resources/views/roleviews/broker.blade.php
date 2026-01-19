<x-app-layout>
    <div class="py-8">
        <div class="mx-auto w-full max-w-7xl px-4 sm:px-6 lg:px-8">
            <form method="GET" action="{{ route('roleviews.broker') }}" class="flex justify-center mb-3 gap-2">
                <input
                    class="bg-2 rounded-lg h-8 w-full max-w-xl px-3"
                    type="text"
                    name="case_id"
                    value="{{ $searchCaseId ?? '' }}"
                    placeholder="Search by case_id"
                >
                <button class="h-8 px-4 rounded bg-gray-900 text-white" type="submit">Search</button>
            </form>

            @if (session('success'))
                <div class="text-center text-sm text-green-700 mb-3">{{ session('success') }}</div>
            @elseif (session('error'))
                <div class="text-center text-sm text-red-700 mb-3">{{ session('error') }}</div>
            @elseif (($searchCaseId ?? '') !== '' && empty($case))
                <div class="text-center text-sm text-gray-600 mb-3">No case found.</div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-3 w-full">
                <div class="bg-white min-h-32 p-6 rounded shadow">
                    <div class="flex items-center justify-between gap-3 mb-2">
                        <div>Cases info</div>

                        <form method="POST" action="{{ isset($case) && $case ? route('broker.cases.screening', $case->case_id) : '#' }}">
                            @csrf
                            @method('PATCH')
                            <button class="px-3 py-1.5 rounded text-sm font-medium bg-gray-500 text-white disabled:bg-gray-300 disabled:text-gray-600 disabled:cursor-not-allowed" type="submit" @disabled(!isset($case) || !$case || $case->status !== 'new')>
                                Send to screening
                            </button>
                        </form>
                    </div>
                    <div>
                        <div>Customs: <span>{{ $case?->checkpoint_id ?? '-' }}</span></div>
                        <div>Status: <span>{{ $case?->status ?? '-' }}</span></div>
                        <div>Arrival time: <span>{{ $case?->arrival_ts ?? '-' }}</span></div>
                    </div>
                </div>
                <div class="bg-white min-h-32 p-6 rounded shadow">
                    <div class="mb-2">Vehicle info</div>
                    <div>
                        <div>Plate_no: <span>{{ $vehicle?->plate_no ?? '-' }}</span></div>
                        <div>Country: <span>{{ $vehicle?->country ?? '-' }}</span></div>
                        <div>Model: <span>{{ $vehicle?->model ?? '-' }}</span></div>
                    </div>
                </div>
        
                <div class="bg-white min-h-32 p-6 rounded shadow">
                    <div class="mb-2">Parties info</div>
                    <div>
                        <div>Declerant: <span>{{ $declerant?->name ?? '-' }}</span></div>
                        <div>Reciever: <span>{{ $consignee?->name ?? '-' }}</span></div>
                    </div>
                </div>
                <div class="bg-white min-h-32 p-6 rounded shadow">
                    <div class="mb-2">Document info</div>
                    <div>
                        <div>Filename: <span>{{ $document?->filename ?? '-' }}</span></div>
                        <div>Category: <span>{{ $document?->category ?? '-' }}</span></div>
                        <div>Uploaded by: <span>{{ $document?->uploaded_by ?? '-' }}</span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
