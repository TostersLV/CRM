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
                                <div class="border rounded-lg p-4 bg-gray-50">
                                    <div class="flex flex-row justify-between">
                                        <div class="font-semibold">Case info </div>
                                        <div class="border rounded-lg mr-1 bg-gray-200 p-1"> Case status</div>
                                    </div>
                                    <div class="mt-1"> cau<span class="font-medium"></span></div>
                                    <div class="mt-3">
                                        <div class="text-sm font-semibold mb-1"></div>
                                        <div class="flex flex-wrap gap-2">
                                                    <span class="inline-block text-xs px-2 py-1 rounded bg-red-50 text-red-700 border border-red-200">
                                                        Risk flags
                                                    </span>
                                                <span class="text-gray-500">none</span>
                                            
                                        </div>
                                    </div>
                                    <div>
                                    <div class="mt-2 font-semibold"> Vehicle info </div>
                                        <div> Plate no: </div>
                                        <div> Make: </div>
                                        <div> Model: </div>
                                    </div>
                                    <div class="my-2 border-1 bg-gray-100 rounded-lg">
                                        <div class="border border-black-300 bg-gray-300 rounded-tl-lg rounded-tr-lg">
                                            <div class="font-semibold pl-2">Document info</div>
                                        </div>
                                        <div class="pl-2">
                                            <div>File name:</div>
                                            <div>Pages: </div>
                                        </div>
                                    </div>
                                    <div class="my-2 border-1 bg-gray-100 rounded-lg">
                                        <div class="border-1 bg-gray-300 rounded-tl-lg rounded-tr-lg">
                                            <div class="font-semibold pl-2">Inspection info</div>
                                        </div>
                                        <div class="pl-2">
                                            <div>Check type:</div>
                                            <div>Location of the vehicle: </div>
                                            </div>
                                            <div class="p-2">
                                            <div class="border rounded-lg bg-gray-200 ">
                                                <div class="border rounded-tl-lg rounded-tr-lg bg-gray-300">
                                                    <div class="font-semibold pl-2">What to check</div>
                                                </div>
                                                <div class="pl-2">
                                                    <div >Name: </div>
                                                    <div>Result:</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <form action="" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <div class="mt-4 flex gap-2">
                                        <input type="text" value="s" hidden>
                                        <button class="px-3 py-1.5 rounded bg-gray-300" name="decision" value="no_risk">Release</button>
                                        <button class="px-3 py-1.5 rounded bg-red-300" name="decision" value="risk">Reject</button>
                                    </div>
                                </form>
                                </div>
                            
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
