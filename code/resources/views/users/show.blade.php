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
=======
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
                {{ __("{$user->name}") }} <!-- Affichage du titre de la page -->
            </h2>
        </x-slot>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                <div class="mt-6">
                    <h3 class="text-5xl font-bold dark:text-white mb-3">Informations</h3>
                    <div class="info-block dark:text-white">
                        <p>Nom: {{$user->name}}</p>
                        <p>Email: {{$user->email}}</p>
                        <p>Role: {{$user->role->name}}</p>
                        <p>Inscrit(e) le: {{$user->created_at}}</p>
                        <div class="actions mt-3">
                            <a href="{{ route("users.edit", ["user" => $user]) }}" class="inline-block bg-blue-500 px-3 py-2 rounded-md mr-2">modifier</a>
                            <form class="m-0 p-2 inline-block" action="{{ route('users.destroy', ['user' => $user]) }}" method="post">
                                @csrf
                                @method('DELETE')

                                <button  type="submit"
                                    @if($user->role_id === 1)
                                        @disabled(true)
                                        class="bg-red-800 px-3 py-2 rounded-md"
                                    @else
                                        class="bg-red-500 px-3 py-2 rounded-md hover:bg-red-600"
                                    @endif
                                >Supprimer</button>
                            </form>
                        </div>

                    </div>

                    @if($user->role_id === 3)
                    <h2 class="text-2xl dark:text-white mt-3">Liste des agences possédés</h2>
                    <div class="mt-2 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <table class="w-full table-auto"> <!-- Définition d'une table -->
                            <thead class="bg-gray-200"> <!-- Définition de l'en-tête de la table -->
                                <tr>
                                    <th class="px-4 py-2 text-center">Nom de l'agence</th>
                                    <th class="px-4 py-2 text-center">Date création</th>
                                </tr>
                            </thead>
                            <tbody> <!-- Corps de la table -->
                                @if(empty($user->agencies))
                                <tr class="hover:bg-gray-100"> <!-- Ajout d'un effet de survol sur chaque ligne de la table -->
                                    <td class="px-4 py-2 text-center">Aucune agences</td>
                                </tr>
                                @else
                                @foreach($user->agencies as $agency)
                                <!-- Boucle qui affiche les données de chaque agence -->
                                <tr class="hover:bg-gray-100"> <!-- Ajout d'un effet de survol sur chaque ligne de la table -->
                                    <td class="px-4 py-2 text-center"><a href="{{ route('agencies.show', ['agency' => $agency]) }}" class="underline">{{ $agency->label }}</a></td>
                                    <td class="px-4 py-2 text-center">{{ \Carbon\Carbon::parse($agency->created_at)->format('d/m/Y h:i') }}</td>
                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                    @endif
                </div>

            </div>
        </div>

    </x-app-layout>
