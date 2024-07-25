<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("Bienvenue sur le tableau de bord de l'application de gestion de location de véhicules.") }}
                </div>
            </div>
        </div>

        @if (Auth::user()->role_id <= 4)
        <!-- Section Agences -->
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-12">
            <div class="bg-gray-100 dark:bg-gray-700 shadow-md rounded-lg p-6">
                <h3 class="font-bold text-xl text-gray-800 dark:text-gray-200 leading-tight mb-4 flex items-center">
                    <i class="fas fa-building text-2xl mr-4"></i>
                    Données des agences
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($data as $item)
                    <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <h4 class="text-lg font-semibold text-gray-900 dark:text-gray-100">{{ $item['agency'] }}</h4>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Statistiques de l'agence</p>
                            </div>
                            <div class="text-3xl text-indigo-500">
                                <i class="fas fa-building"></i>
                            </div>
                        </div>
                        <table class="min-w-full mt-4">
                            <thead>
                                <tr>
                                    <th class="text-left text-gray-500 dark:text-gray-400">Statistique</th>
                                    <th class="text-right text-gray-500 dark:text-gray-400">Valeur</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-left text-gray-700 dark:text-gray-300">Revenu moyen</td>
                                    <td class="text-right text-gray-700 dark:text-gray-300">{{ $item['average_revenue'] }} €</td>
                                </tr>
                                <tr>
                                    <td class="text-left text-gray-700 dark:text-gray-300">Durée moyenne (jours)</td>
                                    <td class="text-right text-gray-700 dark:text-gray-300">{{ $item['average_duration'] }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Section Fournisseurs -->
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-12">
            <div class="bg-gray-100 dark:bg-gray-700 shadow-md rounded-lg p-6">
                <h3 class="font-bold text-xl text-gray-800 dark:text-gray-200 leading-tight mb-4 flex items-center">
                    <i class="fas fa-truck text-2xl mr-4"></i>
                    Données des fournisseurs
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($supplierData as $item)
                    <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <h4 class="text-lg font-semibold text-gray-900 dark:text-gray-100">{{ $item['supplier'] }}</h4>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Statistiques du fournisseur</p>
                            </div>
                            <div class="text-3xl text-green-500">
                                <i class="fas fa-truck"></i>
                            </div>
                        </div>
                        <table class="min-w-full mt-4">
                            <thead>
                                <tr>
                                    <th class="text-left text-gray-500 dark:text-gray-400">Statistique</th>
                                    <th class="text-right text-gray-500 dark:text-gray-400">Valeur</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-left text-gray-700 dark:text-gray-300">Revenu moyen par location</td>
                                    <td class="text-right text-gray-700 dark:text-gray-300">{{ $item['average_revenue'] }} €</td>
                                </tr>
                                <tr>
                                    <td class="text-left text-gray-700 dark:text-gray-300">Durée moyenne (jours)</td>
                                    <td class="text-right text-gray-700 dark:text-gray-300">{{ $item['average_duration'] }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Section Statut des véhicules -->
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-100 dark:bg-gray-700 shadow-md rounded-lg p-6">
                <h3 class="font-bold text-xl text-gray-800 dark:text-gray-200 leading-tight mb-4 flex items-center">
                    <i class="fas fa-car-crash text-2xl mr-4"></i>
                    État des véhicules
                </h3>
                <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <h4 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Nombre par statut</h4>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Statistiques des véhicules</p>
                        </div>
                        <div class="text-3xl text-red-500">
                            <i class="fas fa-car-crash"></i>
                        </div>
                    </div>
                    <table class="min-w-full mt-4">
                        <thead>
                            <tr>
                                <th class="text-left text-gray-500 dark:text-gray-400">Statut</th>
                                <th class="text-right text-gray-500 dark:text-gray-400">Nombre</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-left text-gray-700 dark:text-gray-300">Maintenance</td>
                                <td class="text-right text-gray-700 dark:text-gray-300">{{ $vehicleStatusCount['maintenance'] }}</td>
                            </tr>
                            <tr>
                                <td class="text-left text-gray-700 dark:text-gray-300">Hors service</td>
                                <td class="text-right text-gray-700 dark:text-gray-300">{{ $vehicleStatusCount['out_of_service'] }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @endif
    </div>
</x-app-layout>
