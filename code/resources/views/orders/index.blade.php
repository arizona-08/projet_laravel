<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<style>
    table {
        border: thin solid #000000;
        width: 50%;
        text-align: center;
    }

    td,
    th {
        border: thin solid #e5e7eb;
        width: 50%;
    }
</style>
<x-app-layout>
    <!-- C'est un composant Laravel qui permet de construire des mises en page réutilisables -->
    <x-slot name="header">
        <!-- Définit une section nommée "header" pour placer du contenu dans le haut de la page -->
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Commande') }}
            <!-- Affiche le texte "Commande" à l'aide de la fonction de traduction __() -->
        </h2>
    </x-slot>

    <div class="py-12">
        <!-- Ajoute un espacement en haut et en bas de la page -->
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Centre le contenu horizontalement et défini une largeur maximale -->
            <div class="flex justify-between items-center">
                <!-- Crée un conteneur flexible avec un alignement vertical et horizontal au centre -->
                <h2 class="text-2xl font-bold">Liste des commandes</h2> <!-- Titre principal -->
                <a class="btn btn-light" href="{{ route('orders.create') }}">Ajouter une commande</a>
                <!-- Lien pour ajouter une nouvelle commande -->
            </div>
            <div class="mt-6 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <!-- Crée une boîte blanche avec une ombre et un coin arrondi -->
                <table class="w-full table-auto">
                    <!-- Crée une table avec une largeur maximale et une mise en page automatique -->
                    <thead class="bg-gray-200">
                        <!-- En-tête de la table avec un fond gris pâle -->
                        <tr>
                            <!-- Ligne de la table -->
                            <th class="px-4 py-2 text-center">N° de la commande</th>
                            <th class="px-4 py-2 text-center">Prénom</th>
                            <th class="px-4 py-2 text-center">Nom</th>
                            <th class="px-4 py-2 text-center">Email</th>
                            <th class="px-4 py-2 text-center">Date de début</th>
                            <th class="px-4 py-2 text-center">Date de fin</th>
                            <!-- Cellule de la ligne pour afficher le numéro de la commande -->
                            <th class="px-4 py-2 text-center">Utilisateur</th>
                            <!-- Cellule de la ligne pour afficher le nom de l'utilisateur -->
                            <th class="px-4 py-2 text-center">Marque du véhicule</th>
                            <!-- Cellule de la ligne pour afficher la marque du véhicule -->
                            <th class="px-4 py-2 text-center">Modèle du véhicule</th>
                            <!-- Cellule de la ligne pour afficher le modèle du véhicule -->
                            <th class="px-4 py-2 text-center">Action</th>
                            <!-- Cellule de la ligne pour afficher les actions à effectuer sur la commande -->
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Corps de la table -->
                        @if ($orders->isEmpty())
                            <tr>
                                <td colspan="9" class="px-4 py-2 text-center">Aucune commande à afficher</td>
                            </tr>
                        @else
                        @foreach ($orders as $order)
                            <!-- Boucle qui parcourt toutes les commandes et les affiche dans la table -->
                            <tr class="hover:bg-gray-100">
                                <!-- Ligne de la table qui change de couleur au survol de la souris -->
                                <td class="px-4 py-2 text-center">{{ $order->id }}</td>
                                <td class="px-4 py-2 text-center">{{ $order->firstname }}</td>
                                <td class="px-4 py-2 text-center">{{ $order->lastname }}</td>
                                <td class="px-4 py-2 text-center">{{ $order->email }}</td>
                                <td class="px-4 py-2 text-center">{{ $order->dateDebut }}</td>
                                <td class="px-4 py-2 text-center">{{ $order->dateFin }}</td>
                                <!-- Cellule de la ligne pour afficher le numéro de la commande -->
                                <td class="px-4 py-2 text-center">{{ $order->user->firstname }}
                                    {{ $order->user->lastname }}</td>
                                <!-- Cellule de la ligne pour afficher le nom complet de l'utilisateur associé à la commande -->
                                <td class="px-4 py-2 text-center">{{ $order->vehicle->marque }}</td>
                                <!-- Affiche la marque du véhicule de la commande courante -->
                                <td class="px-4 py-2 text-center">{{ $order->vehicle->model }}</td>
                                <!-- Affiche le modèle du véhicule de la commande courante -->
                                <td class="px-4 py-2 text-center">
                                    <a class="btn btn-light btn-block" role="button"
                                        href="{{ route('order.edit', ['id' => $orders->id]) }}">Modifier</a>
                                    <!-- Bouton pour modifier la orders courante -->
                                    <form action="{{ route('orders.delete', ['id' => $order->id]) }}"
                                        method="post">
                                        @csrf
                                        <!-- Protection contre les attaques CSRF -->
                                        @method('delete')
                                        <!-- Utilise la méthode HTTP DELETE pour supprimer la commande courante -->
                                        <button class="btn btn-light btn-block" type="submit">Supprimer</button>
                                        <!-- Bouton pour supprimer la commande courante -->
                                    </form>
                                </td>
                            </tr>
                        @endforeach <!-- Fin de la boucle qui parcourt toutes les commandes -->
                        @endif
                    </tbody>
                </table> <!-- Fin du tableau qui affiche les commandes -->
            </div>
        </div>
    </div>

</x-app-layout> <!-- Fin du layout de l'application -->