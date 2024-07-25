<style>
    table {
        border: thin solid #000000;
        width: 50%;
        text-align: center;
    }

    td, th {
        border: thin solid #e5e7eb;
        width: 50%;
    }
</style>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Utilisateurs') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="bg-green-500 text-white p-4 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold dark:text-white">Liste des utilisateurs</h2> <!-- Titre de la section -->

                <a class="bg-white px-3 py-2 rounded-md hover:bg-slate-200" href="{{ route('users.create') }}">Ajouter un utilisateur</a>
            </div>
            <div class="mt-6 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <table class="w-full">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="px-4 py-2 text-center">Nom</th>
                            <th class="px-4 py-2 text-center">Email</th>
                            <th class="px-4 py-2 text-center">Role</th>
                            <th class="px-4 py-2 text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr class="hover:bg-gray-100">
                                <td class="px-4 py-2 text-center">{{ $user->name }}</td>
                                <td class="px-4 py-2 text-center">{{ $user->email }}</td>
                                <td class="px-4 py-2 text-center">{{ $user->role->name }}</td>
                                <td class="px-4 py-2 text-center">
                                    <a class="bg-blue-500 px-3 py-2 rounded-md hover:bg-blue-600 block mb-2" href="{{ route('users.edit', $user->id) }}">Modifier</a>
                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 px-3 py-2 rounded-md hover:bg-red-600">Supprimer</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-4">
                {{ $users->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
