<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-white leading-tight">
            @if(isset($singleRole))
                {{ __("Créer un(e) {$singleRole->name} ") }}
            @else
                {{ __("Créer un nouvel utilisateur ") }}
            @endif
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('users.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="name" class="block text-gray-700">Nom</label>
                            <input type="text" name="name" id="name" class="w-full px-4 py-2 border rounded-md" value="{{ old('name') }}" required>
                        </div>
                        <div class="mb-4">
                            <label for="email" class="block text-gray-700">Email</label>
                            <input type="email" name="email" id="email" class="w-full px-4 py-2 border rounded-md" value="{{ old('email') }}" required>
                        </div>
                        <div class="mb-4">
                            <label for="role_id" class="block text-gray-700">Rôle</label>
                            <select name="role_id" id="role_id" class="w-full px-4 py-2 border rounded-md" required onchange="toggleAgencyField(this)">
                                @if(isset($singleRole))
                                    <option value="{{ $singleRole->id }}">{{ $singleRole->name }}</option>
                                @else
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div>
                            <button type="submit" class="bg-blue-500 px-4 py-2 rounded-md hover:bg-blue-600 text-white">Ajouter</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleAgencyField(roleSelect) {
            var agencyField = document.getElementById('agency_field');
            if (roleSelect.value == '{{ config('roles.roles.agencyHead') }}') {
                agencyField.style.display = 'block';
            } else {
                agencyField.style.display = 'none';
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            var roleSelect = document.getElementById('role_id');
            toggleAgencyField(roleSelect);
        });
    </script>
</x-app-layout>
