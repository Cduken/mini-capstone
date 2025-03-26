
<x-app-layout>
    <div class="flex min-h-screen bg-gray-100">
        <!-- Sidebar -->
        <x-admin-sidebar />

        <!-- Main Content -->
        <div class="flex-1 p-6">
            <h2 class="text-2xl font-semibold mb-6">Edit User</h2>
            <div class="bg-white shadow-lg rounded-lg overflow-hidden p-6">
                <form method="POST" action="{{ route('admin.users.update', $user->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="name" class="block text-gray-700 font-semibold mb-2">Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" class="w-full px-4 py-2 border rounded-lg @error('name') border-red-500 @enderror">
                        @error('name')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="email" class="block text-gray-700 font-semibold mb-2">Email</label>
                        <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" class="w-full px-4 py-2 border rounded-lg @error('email') border-red-500 @enderror">
                        @error('email')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="userType" class="block text-gray-700 font-semibold mb-2">User Type</label>
                        <select name="userType" id="userType" class="w-full px-4 py-2 border rounded-lg @error('userType') border-red-500 @enderror">
                            <option value="user" {{ old('userType', $user->userType) == 'user' ? 'selected' : '' }}>User</option>
                            <option value="admin" {{ old('userType', $user->userType) == 'admin' ? 'selected' : '' }}>Admin</option>
                        </select>
                        @error('userType')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg">Update User</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
