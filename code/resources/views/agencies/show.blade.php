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
                {{ __("Agence: $agency->label") }} <!-- Affichage du titre de la page -->
            </h2>
        </x-slot>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="mt-6 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <table class="w-full table-auto"> <!-- Définition d'une table -->
                        <thead class="bg-gray-200"> <!-- Définition de l'en-tête de la table -->
                            <tr>
                                <th class="px-4 py-2 text-center">Nom de l'agence</th> <!-- Titre de la première colonne -->
                                <th class="px-4 py-2 text-center">Chef d'agence</th> <!-- Titre de la deuxième colonne -->
                                <th class="px-4 py-2 text-center">Nombre de véhicules</th> <!-- Titre de la troisième colonne -->
                            </tr>
                        </thead>
                        <tbody> <!-- Corps de la table -->
                            <!-- Boucle qui affiche les données de chaque agence -->
                            <tr class="hover:bg-gray-100"> <!-- Ajout d'un effet de survol sur chaque ligne de la table -->
                                <td class="px-4 py-2 text-center">{{ $agency->label }}</td> <!-- Affichage du nom de l'agence dans la première colonne -->
                                <td class="px-4 py-2 text-center">{{ $agency->user->name }}</td> <!-- Affichage du prénom du chef d'agence dans la deuxième colonne -->
                                <td class="text-center p-2">{{ $agency->vehicles_count }}</form>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="mt-6">
                    <h3 class="text-2xl dark:text-white">Liste des véhicules possédés</h3>
                    <div class="mt-2 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <table class="w-full table-auto"> <!-- Définition d'une table -->
                            <thead class="bg-gray-200"> <!-- Définition de l'en-tête de la table -->
                                <tr>
                                    <th class="px-4 py-2 text-center">Marque</th>
                                    <th class="px-4 py-2 text-center">Modèle</th>
                                    <th class="px-4 py-2 text-center">Dernière maintenance</th>
                                    <th class="px-4 py-2 text-center">Nombre de kilomètres</th>
                                    <th class="px-4 py-2 text-center">Numéro de série</th>
                                    <th class="px-4 py-2 text-center">Statut</th>
                                    {{-- <th class="px-4 py-2 text-center">Fournisseur</th> --}}
                                </tr>
                            </thead>
                            <tbody> <!-- Corps de la table -->
                                @if(empty($agency->vehicles))
                                <tr class="hover:bg-gray-100"> <!-- Ajout d'un effet de survol sur chaque ligne de la table -->
                                    <td class="px-4 py-2 text-center">Cette agence ne possède aucun véhicules</td>
                                </tr>
                                @else
                                @foreach($agency->vehicles as $vehicle)
                                <!-- Boucle qui affiche les données de chaque agence -->
                                <tr class="hover:bg-gray-100"> <!-- Ajout d'un effet de survol sur chaque ligne de la table -->
                                    <td class="px-4 py-2 text-center">{{ $vehicle->marque }}</td>
                                    <td class="px-4 py-2 text-center">{{ $vehicle->model }}</td>
                                    <td class="px-4 py-2 text-center">{{ $vehicle->last_maintenance }}</td>
                                    <td class="px-4 py-2 text-center">{{ $vehicle->nb_kilometrage }}</td>
                                    <td class="px-4 py-2 text-center">{{ $vehicle->nb_serie }}</td>
                                    <td class="px-4 py-2 text-center">{{ $vehicle->status->label }}</td>
                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                
            </div>
        </div>
    
    </x-app-layout>