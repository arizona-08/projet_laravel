<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Modifier l\'utilisateur') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if ($errors->any())
                        <div class="bg-red-500 text-white p-4 rounded mb-4">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('users.update', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label for="name" class="block text-gray-700">Nom</label>
                            <input type="text" name="name" id="name" class="w-full px-4 py-2 border rounded-md" value="{{ $user->name }}" required>
                        </div>
                        <div class="mb-4">
                            <label for="email" class="block text-gray-700">Email</label>
                            <input type="email" name="email" id="email" class="w-full px-4 py-2 border rounded-md" value="{{ $user->email }}" required>
                        </div>
                        <div class="mb-4">
                            <label for="password" class="block text-gray-700">Mot de passe (laisser vide pour ne pas modifier)</label>
                            <input type="password" name="password" id="password" class="w-full px-4 py-2 border rounded-md">
                        </div>
                        <div class="mb-4">
                            <label for="password_confirmation" class="block text-gray-700">Confirmer le mot de passe</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="w-full px-4 py-2 border rounded-md">
                        </div>
                        <div class="mb-4">
                            <label for="role_id" class="block text-gray-700">Rôle</label>
                            <select name="role_id" id="role_id" class="w-full px-4 py-2 border rounded-md" required>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}" {{ $user->role_id == $role->id ? '
