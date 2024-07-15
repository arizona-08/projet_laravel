<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl dark:text-white text-gray-800 leading-tight">
            {{ __("Modifier l'utilisateur") }}
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

                    <form action="{{ route('users.update', ['user' => $user]) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="overflow-x-auto">
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
                                        <td class="border px-4 py-2">
                                            <input type="text" name="name" placeholder="Nom" value="{{ $user->name }}" class="w-full">
                                        </td>
                                        <td class="border px-4 py-2">
                                            <input type="email" name="email" placeholder="Email" value="{{ $user->email }}" class="w-full">
                                        </td>
                                        <td class="border px-4 py-2">
                                            <select name="role" placeholder="Mot de passe" class="w-full" onchange="toggleAgencyField(this)">
                                                @foreach($roles as $role)
                                                    <option value="{{$role->id}}" @if($user->role_id == $role->id) selected @endif>{{$role->name}}</option>
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

    <script>
        function toggleAgencyField(roleSelect) {
            var agencyField = document.getElementById('agency_field');
            if (roleSelect.value == '2') { // Assurez-vous que 2 est bien l'ID du rôle "Chef d'agence"
                agencyField.style.display = 'block';
            } else {
                agencyField.style.display = 'none';
            }
        }
        // Appel initial pour afficher ou masquer le champ Agence selon le rôle actuel de l'utilisateur
        document.addEventListener('DOMContentLoaded', function() {
            var roleSelect = document.querySelector('select[name="role"]');
            toggleAgencyField(roleSelect);
        });
    </script>
</x-app-layout>
