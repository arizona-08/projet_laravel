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
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Roles') }} <!-- Affichage du titre de la page -->
            </h2>
        </x-slot>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="flex justify-between items-center">
                    <h2 class="text-2xl font-bold dark:text-white">Liste des roles</h2> <!-- Titre de la section -->
                    {{-- <a class="bg-white px-3 py-2 rounded-md hover:bg-slate-200" href="{{ route('roles.create') }}">Ajouter un role</a> <!-- Bouton pour ajouter une agence --> --}}
                </div>
                <div class="mt-6 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <table class="w-full table-auto"> <!-- Définition d'une table -->
                        <thead class="bg-gray-200"> <!-- Définition de l'en-tête de la table -->
                            <tr>
                                <th class="px-4 py-2 text-center">Role</th> <!-- Titre de la première colonne -->
                                <th class="px-4 py-2 text-center">Nombre d'utilisateur</th> <!-- Titre de la deuxième colonne -->
                                <th class="px-4 py-2 text-center">Actions</th> <!-- Titre de la troisième colonne -->

                            </tr>
                        </thead>
                        <tbody> <!-- Corps de la table -->
                            @if ($roles->isEmpty())
                                <tr>
                                    <td colspan="9" class="px-4 py-2 text-center">Aucun rôle à afficher</td>
                                </tr>
                            @else
                            <!-- Boucle qui affiche les données de chaque agence -->
                            @foreach ($roles as $role)
                            <tr class="hover:bg-gray-100"> <!-- Ajout d'un effet de survol sur chaque ligne de la table -->
                                <td class="px-4 py-2 text-center underline">
                                    <a href="{{ route('roles.show', ['role' => $role]) }}" role="button">Voir les {{ $role->name }}</a>
                                </td>
                                 <!-- Affichage du nom du role dans la première colonne -->
                                <td class="px-4 py-2 text-center">{{ $role->users_count }}</td> <!-- Affichage du nombre d'utilisateur ayant ce rôle dans la deuxième colonne -->
                                <td class="text-center px-4 py-2">
                                    <a class="bg-blue-500 px-3 py-2 rounded-md hover:bg-blue-600 block mb-2" role="button" href="{{ route('roles.edit', ['role' => $role]) }}">Modifier</a>
                                </td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </x-app-layout>
