<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Orders') }}
            <!-- Afficher "Orders" -->
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if ($errors->any())
                        <!-- Si des erreurs ont été détectées dans la validation de formulaire -->
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <!-- Boucle à travers toutes les erreurs -->
                                    <li>{{ $error }}</li> <!-- Afficher chaque erreur -->
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('orders.update', ['id' => $order->id]) }}" method="post">
                        <!-- Formulaire de modification de orders avec la méthode HTTP POST -->
                        @csrf
                        <!-- Protection contre les attaques CSRF -->
                        @method('PUT')
                        <!-- Utiliser la méthode HTTP PUT pour la modification -->
                        <div class="overflow-x-auto">
                            <table class="table-auto w-full">
                                <thead>
                                    <tr class="bg-gray-100">
                                        <th class="px-4 py-2 text-left">Véhicules</th>
                                        <!-- Colonne pour la sélection de véhicule -->
                                        <th class="px-4 py-2 text-left">Utilisateurs</th>
                                        <!-- Colonne pour la sélection d'utilisateur -->
                                        <th class="px-4 py-2 text-left">Action</th>
                                        <!-- Colonne pour le bouton de validation -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="border px-4 py-2 text-center">
                                            <select name="vehicle_id" id="">
                                                <!-- Liste déroulante pour la sélection de véhicule -->
                                                @foreach ($vehicles as $vehicle)
                                                    <!-- Boucle à travers tous les véhicules disponibles -->
                                                    <option value="{{ $vehicle->id }}">{{ $vehicle->marque }}
                                                        {{ $vehicle->model }}</option>
                                                    <!-- Ajouter une option pour chaque véhicule -->
                                                @endforeach
                                            </select>
                                        </td>
                                        <td class="border px-4 py-2 text-center">
                                            <select name="users_id" id="">
                                                <!-- Liste déroulante pour la sélection d'utilisateur -->
                                                @foreach ($users as $user)
                                                    <!-- Boucle à travers tous les utilisateurs disponibles -->
                                                    <option value="{{ $user->id }}">{{ $user->firstname }}
                                                        {{ $user->lastname }}</option>
                                                    <!-- Ajouter une option pour chaque utilisateur -->
                                                @endforeach
                                            </select>
                                        </td>
                                        <td class="border px-4 py-2 text-center">
                                            <button type="submit"
                                                class="bg-blue-500 hover:bg-blue-700 text-black font-bold py-2 px-4 rounded">Valider</button>
                                            <!-- Bouton de validation -->
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