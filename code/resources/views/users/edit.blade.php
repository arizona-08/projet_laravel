<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl dark:text-white text-gray-800 leading-tight">
            {{ __("Modifier l'utilisateur") }}
        </h2>
    </x-slot>


    <!-- Section principale de la page -->
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Conteneur pour la partie principale de la page -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- Afficher les erreurs de validation si elles existent -->
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Formulaire pour la modification du fournisseur -->
                    <form action="{{ route('users.update', ['user' => $user]) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="overflow-x-auto">
                            <!-- Tableau pour afficher les données à modifier -->
                            <table class="table-auto w-full">
                                <thead>
                                    <tr class="bg-gray-100">
                                        <th class="px-4 py-2 text-left">Nom</th>
                                        <th class="px-4 py-2 text-left">Email</th>
                                        <th class="px-4 py-2 text-left">Role</th>
                                        <th class="px-4 py-2 text-left">Mot de passe</th>
                                        <th class="px-4 py-2 text-left">Confirmation du mot de passe</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <!-- Champ pour modifier le nom de l'utilisateur -->
                                        <td class="border px-4 py-2">
                                            <input type="text" name="name" placeholder="Nom"
                                                value="{{ $user->name }}" class="w-full">
                                        </td>

                                        <td class="border px-4 py-2">
                                            <input type="email" name="email" placeholder="Email"
                                                value="{{ $user->email }}" class="w-full">
                                        </td>

                                        <td class="border px-4 py-2">
                                            <select name="role" placeholder="Mot de passe" class="w-full"
                                            @php
                                                $configRoles = config("roles.roles")
                                            @endphp
                                            @if($user->role->id === $configRoles["admin"] && $allAdminsCount <= 1)
                                                @disabled(true)
                                            @endif
                                            >
                                                @foreach($roles as $role)
                                                    <option value="{{$role->id}}">{{$role->name}}</option>
                                                @endforeach
                                            </select>
                                        </td>

                                        <td class="border px-4 py-2">
                                            <input type="password" name="password" placeholder="Mot de passe" class="w-full">
                                        </td>

                                        <td class="border px-4 py-2">
                                            <input type="password" name="password_confirmation" placeholder="Confirmation du mdp" class="w-full">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="actions mt-3">
                                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-black font-bold py-2 px-4 rounded">Valider</button>
                                <a href="{{route("users.show", ["user" => $user])}}" role="button" class="bg-red-500 hover:bg-red-700 text-black font-bold py-2 px-4 inline-block rounded">Annuler</a>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
