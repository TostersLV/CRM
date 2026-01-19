<x-app-layout>
    <div class="py-8">
        <div class="max-w-xl mx-auto bg-white p-6 rounded">
            <a href="{{ route('roleviews.admin') }}" class="inline-flex items-center gap-2 text-sm text-gray-600 hover:text-gray-900">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="h-4 w-4">
                    <path fill-rule="evenodd" d="M11.78 15.53a.75.75 0 0 1-1.06 0l-5-5a.75.75 0 0 1 0-1.06l5-5a.75.75 0 1 1 1.06 1.06L7.31 9.25H16a.75.75 0 0 1 0 1.5H7.31l4.47 4.47a.75.75 0 0 1 0 1.06Z" clip-rule="evenodd" />
                </svg>
                <span>Back to users</span>
            </a>

            <h2 class="">Edit user</h2>

            <form method="POST" action="{{ route('admin.users.update', $user) }}" class="mt-6 space-y-4">
                @csrf
                @method('PUT')

                <div>
                    <label class="" for="full_name">Full name</label>
                    <input id="full_name" name="full_name" type="text" value="{{ old('full_name', $user->full_name) }}" class="mt-1 block w-full rounded" required>
                </div>

                <div>
                    <label class="" for="role">Role</label>
                    <select id="role" name="role" class="mt-1 w-full rounded" required>
                        
                        @foreach ($roles as $role)
                            <option>{{ $role }} </option>
                        @endforeach
                    </select>
                    
                </div>

                <div class="flex items-center gap-2">
                    <input id="active" name="active" type="checkbox" value="1" class="rounded border-gray-300" @checked(old('active', $user->active))>
                    <label for="active">Active</label>
                </div>

                <div class="flex items-center justify-end gap-3 pt-2">
                    <a href="{{ route('roleviews.admin') }}" class="">Cancel</a>
                    <button type="submit" class="px-4 py-2 rounded ">Save</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
