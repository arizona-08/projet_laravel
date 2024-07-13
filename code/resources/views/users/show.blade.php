<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Détails de l\'utilisateur') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="mb-4">
                        <strong>Nom:</strong> {{ $user->name }}
                    </div>
                    <div class="mb-4">
                        <strong>Email:</strong> {{ $user->email }}
                    </div>
                    <div class="mb-4">
                        <strong>Rôle:</strong> {{ $user->role->name }}
                    </div>
                    <div class="mt-4">
                        <a class="bg-blue-500 px-4 py-2 rounded-md hover:bg-blue-600 text-white" href="{{ route('users.index') }}">Retour</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
