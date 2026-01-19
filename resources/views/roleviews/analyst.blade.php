<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex items-center justify-between gap-4">
                        <h3 class="text-lg font-semibold">Screening queue</h3>
                        <div id="refresh" class="text-sm ">Refreshing every 4 seconds...</div>
                        
                    </div>

                    <div class="mt-4 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @if (!empty($screeningCases) && $screeningCases->count() > 0)
                            @foreach ($screeningCases as $case)
                                <div class="border rounded-lg p-4 bg-gray-50">
                                    <div class="font-semibold">Case: {{ $case->case_id }}</div>
                                    <div class="mt-1">Origin: <span class="font-medium">{{ $case->origin_country }}</span></div>
                                    <div class="mt-3">
                                        <div class="text-sm font-semibold mb-1">Risk flags</div>
                                        <div class="flex flex-wrap gap-2">
                                            @if ($case->risk_flags && $case->risk_flags->count() > 0)
                                                @foreach ($case->risk_flags as $flag)
                                                    <span class="inline-block text-xs px-2 py-1 rounded bg-red-50 text-red-700 border border-red-200">
                                                        {{ $flag->flag }}
                                                    </span>
                                                @endforeach
                                            @else
                                                <span class="text-gray-500">None</span>
                                            @endif
                                        </div>
                                    </div>
                                <form action="{{ route('roleview.analyst', $case->case_id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <div class="mt-4 flex gap-2">
                                        <input type="text" value="{{ $case->id }}" hidden>
                                        <button class="px-3 py-1.5 rounded bg-gray-300" name="decision" value="no_risk">No risk</button>
                                        <button class="px-3 py-1.5 rounded bg-red-300" name="decision" value="risk">Risk</button>
                                    </div>
                                </form>
                                </div>
                            @endforeach
                        @else
                            <div class="text-gray-600">No cases in screening.</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
         function autoRefresh() {
            window.location = window.location.href;
        }
        setInterval('autoRefresh()', 4000);

        let timeout;
        window.addEventListener("scroll", ()=>{
            clearTimeout(timeout);
            timeout = setTimeout(() =>{
                localStorage.setItem("scrollY", window.scrollY);
            }, 200);
        });
        window.addEventListener("load", ()=> {
            const savedY = localStorage.getItem("scrollY");
            if (scrollY !== null){
                window.scrollTo(0, parseInt(savedY));
            }
        })

      
        
    </script>
</x-app-layout>