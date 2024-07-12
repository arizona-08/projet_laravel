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
        <h2 class="font-semibold text-xl text-gray-800 dark:text-white leading-tight">
            {{ __('Commande') }}
            <!-- Affiche le texte "Commande" à l'aide de la fonction de traduction __() -->
        </h2>
    </x-slot>
    
    <div class="py-12">
        <!-- Ajoute un espacement en haut et en bas de la page -->
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8  dark:text-white">
            <!-- Centre le contenu horizontalement et défini une largeur maximale -->
            <div class="flex justify-between items-center">
                <!-- Crée un conteneur flexible avec un alignement vertical et horizontal au centre -->
                <h2 class="text-2xl font-bold dark:text-white ">Liste des commandes</h2> <!-- Titre principal -->
                <a class="btn btn-light dark:text-white" href="{{ route('orders.create') }}">Ajouter une commande</a>
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
                            <!-- Cellule de la ligne pour afficher le numéro de la commande -->
                            <th class="px-4 py-2 text-center">N° de la commande</th>
                            <th class="px-4 py-2 text-center">Locataire</th>
                            <th class="px-4 py-2 text-center">Email</th>
                            <th class="px-4 py-2 text-center">Date de début</th>
                            <th class="px-4 py-2 text-center">Date de fin</th>
                            <th class="px-4 py-2 text-center">Marque du véhicule</th>
                            <th class="px-4 py-2 text-center">Modèle du véhicule</th>
                            <th class="px-4 py-2 text-center">Statut de la commande</th>
                            <th class="px-4 py-2 text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Corps de la table -->
                        @if (empty($orders))
                        <tr>
                            <td colspan="9" class="px-4 py-2 text-center">Aucune commande à afficher</td>
                        </tr>
                        @else
                        @foreach ($orders as $order)
                        <!-- Boucle qui parcourt toutes les commandes et les affiche dans la table -->
                        <tr class="hover:bg-gray-100">
                            <!-- Ligne de la table qui change de couleur au survol de la souris -->
                            <td class="px-4 py-2 text-center">{{ $order->id }}</td>
                            <td class="px-4 py-2 text-center">{{ $order->user->name }}</td>
                            <td class="px-4 py-2 text-center">{{ $order->user->email }}</td>
                            <td class="px-4 py-2 text-center">{{ \Carbon\Carbon::parse($order->start_date)->format('d/m/Y h:i') }}</td>
                            <td class="px-4 py-2 text-center">{{ \Carbon\Carbon::parse($order->end_date)->format('d/m/Y h:i') }}</td>
                            <!-- Cellule de la ligne pour afficher le nom complet de l'utilisateur associé à la commande -->
                            <td class="px-4 py-2 text-center">{{ $order->vehicle->marque }}</td>
                            <!-- Affiche la marque du véhicule de la commande courante -->
                            <td class="px-4 py-2 text-center">{{ $order->vehicle->model }}</td>
                            <!-- Affiche le modèle du véhicule de la commande courante -->
                            <td 
                                @switch($order->orderstatus->id)
                                    @case(0)
                                        class="px-4 py-2 text-center text-red-500"
                                    @break
                                    @case(1)
                                        class="px-4 py-2 text-center text-orange-300"
                                    @break
                                    @case(2)
                                        class="px-4 py-2 text-center text-green-500"
                                    @break
                                    @case(3)
                                        class="px-4 py-2 text-center text-red-500"
                                    @break
                                @endswitch
                            >{{ $order->orderstatus->label }}</td>
                            <td class="px-4 py-2 text-center">
                                <a class="bg-blue-500 px-3 py-2 rounded-md hover:bg-blue-600 block mb-2" role="button" href="{{ route('orders.edit', ['order' => $order]) }}">Modifier</a>
                                
                                <!-- Bouton pour modifier la commande courante -->
                                <form action="{{ route('orders.handleOrder', ['order' => $order]) }}" method="post">
                                    @csrf
                                    @method('PUT')
                                    <!-- Protection contre les attaques CSRF -->
                                    <input type="hidden" name="order_status_id" value="2">
                                    <!-- Utilise la méthode HTTP DELETE pour supprimer la commande courante -->
                                    <button class="bg-green-500 px-3 py-2 rounded-md hover:bg-green-600 block" type="submit">Valider</button>
                                    <!-- Bouton pour supprimer la commande courante -->
                                </form>
                                <form action="{{ route('orders.handleOrder', ['order' => $order]) }}" method="post">
                                    @csrf
                                    @method('put')
                                    <!-- Protection contre les attaques CSRF -->
                                    <input type="hidden" name="order_status_id" value="0">
                                    <!-- Utilise la méthode HTTP DELETE pour supprimer la commande courante -->
                                    <button class="bg-orange-500 px-3 py-2 rounded-md hover:bg-orange-600 block" type="submit">Rejeter</button>
                                    <!-- Bouton pour supprimer la commande courante -->
                                </form>
                                <form action="{{ route('orders.destroy', ['order' => $order]) }}" method="post">
                                    @csrf
                                    <!-- Protection contre les attaques CSRF -->
                                    @method('delete')
                                    <!-- Utilise la méthode HTTP DELETE pour supprimer la commande courante -->
                                    <button class="bg-red-500 px-3 py-2 rounded-md hover:bg-red-600" type="submit">Supprimer</button>
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