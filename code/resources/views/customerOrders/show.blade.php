<!-- Définition d'un style CSS pour les tables -->
<style>
    table {
        border: thin solid #000000; /* bordure fine noire */
        width: 50%; /* largeur de 50% de la page */
        text-align: center; /* centrage du texte */
        }
        td, th {
        border: thin solid #e5e7eb; /* bordure fine gris clair */
        width: 50%; /* largeur de 50% de la page */
    }
    </style>
    
    <!-- Utilisation d'un composant Laravel pour générer la page HTML -->
    <x-app-layout>
        <!-- Définition d'un emplacement pour le titre de la page -->
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-white leading-tight">
                {{ __("Commander: $vehicle->marque $vehicle->model") }} <!-- Affichage du titre de la page -->
            </h2>
        </x-slot>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="mt-6">
                    <h3 class="text-2xl dark:text-white">Liste des véhicules possédés</h3>
                    <div class="mt-2 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <form action="{{route("customerOrders.store")}}" method="post">
                            @csrf
                            <table class="w-full table-auto"> <!-- Définition d'une table -->
                                <thead class="bg-gray-200"> <!-- Définition de l'en-tête de la table -->
                                    <tr>
                                        <th class="px-4 py-2 text-center">Marque</th>
                                        <th class="px-4 py-2 text-center">Modèle</th>
                                        <th class="px-4 py-2 text-center">Dernière maintenance</th>
                                        <th class="px-4 py-2 text-center">Nombre de kilomètres</th>
                                        <th class="px-4 py-2 text-center">Numéro de série</th>
                                        <th class="px-4 py-2 text-center">Début</th>
                                        <th class="px-4 py-2 text-center">Fin</th>
                                        <th class="px-4 py-2 text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody> <!-- Corps de la table -->
                                    <!-- Boucle qui affiche les données de chaque agence -->
                                    <tr class="hover:bg-gray-100"> <!-- Ajout d'un effet de survol sur chaque ligne de la table -->
                                        <td class="px-4 py-2 text-center">{{ $vehicle->marque }}</td>
                                        <input type="text" name="vehicle_id" value="{{$vehicle->id}}" hidden>
                                        <input type="text" name="user_id" value="{{$user->id}}" hidden>
                                        <td class="px-4 py-2 text-center">{{ $vehicle->model }}</td>
                                        <td class="px-4 py-2 text-center">{{ $vehicle->last_maintenance }}</td>
                                        <td class="px-4 py-2 text-center">{{ $vehicle->nb_kilometrage }}</td>
                                        <td class="px-4 py-2 text-center">{{ $vehicle->nb_serie }}</td>
                                        <td class="px-4 py-2 text-center">
                                            @if ($errors->has('start_date'))
                                                <div class="text-red-500 font-semibold my-2">
                                                    {{ $errors->first('start_date') }}
                                                </div>
                                            @endif
                                            <input type="date" name="start_date" id="">
                                        </td>
                                        <td class="px-4 py-2 text-center">
                                            @if ($errors->has('end_date'))
                                                <div class="text-red-500 font-semibold my-2">
                                                    {{ $errors->first('end_date') }}
                                                </div>
                                            @endif
                                            <input type="date" name="end_date" id="">
                                        </td>
                                        <td class="px-4 py-2 text-center">
                                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-black font-bold py-2 px-4 rounded">Commander</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </form>
                        
                    </div>
                </div>
                
            </div>
        </div>
    
    </x-app-layout>