<x-app-layout>
    <div class="py-8">
        <div class="flex flex-row min-h-full justify-center">
            <div class="bg-white min-h-full w-1/3 p-6 rounded">
                <div class="flex justify-center "> 
                    <input class="bg-2 rounded-lg h-8 w-96" id="search" type="text" placeholder="search">
                </div>
            
                <div class="">
                    <div>
                        Lietotaji
                    </div>
                    <div>
                        <table class="w-full">
                            <tr class="flex items-center justify-between">
                                <th class="w-1/3 text-left">Name</th>
                                <th class="w-1/3 text-left">Role</th>
                                <th class="w-1/3 text-left">Active/Inactive</th>
                                <th class="w-1/3 text-left">Edit</th>
                            </tr>
                            @foreach($users as $user)
                            <tr user class="flex items-center justify-between border-4 border-solid border-gray rounded-lg mb-2 p-1">
                                
                                <th full-name class="w-1/3 text-left">{{ $user->full_name}}</th>
                                <th class="w-1/3 text-left">{{ $user->role}}</th>
                                <th class="w-1/3 text-left">{{ $user->active ? 'Active' : 'Inactive'}}</th>
                                <th class="w-1/3 text-left">
                                    <a href="{{ route('admin.users.edit', $user) }}" class="text-indigo-600 hover:underline">Edit</a>
                                </th>
                               
                            </tr>
                             @endforeach
                            
                            
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const search = document.getElementById('search');
        const user = document.querySelectorAll('[user]');

        search.addEventListener('input', () => {
        const val = search.value.toLowerCase().trim();

        user.forEach(row => {
            
            const fullName = row.querySelector('[full-name]').textContent.toLowerCase();
            
            if (fullName.includes(val)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });
    </script>
</x-app-layout>
