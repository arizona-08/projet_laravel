<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-white leading-tight">
            {{ __("Modifier l'agence: $agency->label") }}
            <!-- Affichage du titre de la page -->
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if ($errors->any())
                    <!-- Vérification si des erreurs sont présentes -->
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <!-- Boucle sur toutes les erreurs -->
                            <li>{{ $error }}</li> <!-- Affichage des erreurs -->
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <form action="{{ route('agencies.update', ['agency' => $agency]) }}" method="post">
                        <!-- Formulaire avec la méthode POST et l'action de mise à jour de l'agence -->
                        @csrf
                        <!-- Protection CSRF -->
                        @method('PUT')
                        <!-- Utilisation de la méthode PUT pour la mise à jour -->
                        <div class="overflow-x-auto">
                            <table class="table-auto w-full">
                                <thead>
                                    <tr class="bg-gray-100">
                                        <th class="px-4 py-2 text-left">Nom de l'agence</th>
                                        <!-- Affichage du nom de l'agence dans la première colonne du tableau -->
                                        <th class="px-4 py-2 text-left">Chef d'agence</th>
                                        <!-- Affichage du chef d'agence dans la deuxième colonne du tableau -->
                                        <th class="px-4 py-2 text-center">Adresse</th>
                                        <th class="px-4 py-2 text-center">Ville</th>
                                        <th class="px-4 py-2 text-center">Code postal</th>
                                        <th class="px-4 py-2 text-left">Action</th>
                                        <!-- Affichage de l'action dans la troisième colonne du tableau -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="border px-4 py-2">
                                            @if ($errors->has('label'))
                                                <div class="text-red-500 font-semibold my-2">
                                                    {{ $errors->first('label') }}
                                                </div>
                                            @endif
                                            <input type="text" name="label" placeholder="Nom de l'agence"
                                                value="{{ $agency->label }}" class="w-full">
                                            <!-- Champ d'édition du nom de l'agence -->
                                        </td>
                                        <td class="border px-4 py-2 text-center">
                                            <select name="user_id" id="">
                                                <!-- Sélecteur du chef d'agence -->

                                                @foreach ($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                <!-- Affichage du nom de chaque utilisateur dans une option -->
                                                @endforeach
                                            </select>
                                        </td>
                                        <!-- Ajouter une cellule pour le champ de saisie de l'adresse de l'agence -->
                                        <td class="border px-4 py-2 text-center">
                                            @if ($errors->has('address'))
                                            <div class="text-red-500 font-semibold my-2">
                                                {{ $errors->first('address') }}
                                            </div>
                                            @endif
                                            <input type="text" name="address" placeholder="Adresse" class="w-full">
                                        </td>
                                        <!-- Ajouter une cellule pour le champ de saisie de la ville de l'agence -->

                                        <td class="border px-4 py-2 text-center">
                                            @if ($errors->has('city'))
                                            <div class="text-red-500 font-semibold my-2">
                                                {{ $errors->first('city') }}
                                            </div>
                                            @endif
                                            <input type="text" name="city" placeholder="Ville" class="w-full">
                                        </td>
                                        <!-- Ajouter une cellule pour le champ de saisie du code postal de l'agence -->
                                        <td class="border px-4 py-2 text-center">
                                            @if ($errors->has('zip_code'))
                                            <div class="text-red-500 font-semibold my-2">
                                                {{ $errors->first('zip_code') }}
                                            </div>
                                            @endif
                                            <input type="number" name="zip_code" placeholder="Code postal" class="w-full">
                                        </td>
                                        <td class="border px-4 py-2 text-center">
                                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-black font-bold py-2 px-4 rounded">Valider</button>
                                            <!-- Bouton de validation pour la mise à jour de l'agence -->
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


</x-app-layout>