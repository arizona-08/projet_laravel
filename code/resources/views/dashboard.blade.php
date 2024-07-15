<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("Bienvenue sur le tableau de bord de l'application de gestion de location de véhicules.") }}
                </div>
            </div>
        </div>
    </div>

    @if (Auth::user()->role_id <= 4)
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="font-semibold text-lg">Données des agences</h3>

                    <h3 class="mt-6">Revenu moyen par location</h3>
                    <table class="min-w-full mt-4">
                        <thead>
                            <tr class="bg-gray-200 dark:bg-gray-700">
                                <th class="py-2 text-center">Agence</th>
                                <th class="py-2 text-center">Revenu moyen</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                            <tr class="border-b">
                                <td class="py-2 text-center">{{ $item['agency'] }}</td>
                                <td class="py-2 text-center">{{ $item['average_revenue'] }} €</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <h3 class="mt-6">Revenu moyen par location sans agence intermédiaire</h3>
                    <table class="min-w-full mt-4">
                        <thead>
                            <tr class="bg-gray-200 dark:bg-gray-700">
                                <th class="py-2 text-center">Fournisseur</th>
                                <th class="py-2 text-center">Revenu moyen</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($supplierData as $item)
                            <tr class="border-b">
                                <td class="py-2 text-center">{{ $item['supplier'] }}</td>
                                <td class="py-2 text-center">{{ $item['average_revenue'] }} €</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <h3 class="mt-6">Durée moyenne des locations</h3>
                    <table class="min-w-full mt-4">
                        <thead>
                            <tr class="bg-gray-200 dark:bg-gray-700">
                                <th class="py-2 text-center">Agence</th>
                                <th class="py-2 text-center">Durée moyenne (jours)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                            <tr class="border-b">
                                <td class="py-2 text-center">{{ $item['agency'] }}</td>
                                <td class="py-2 text-center">{{ $item['average_duration'] }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <h3 class="mt-6">Durée moyenne des locations sans agence intermédiaire</h3>
                    <table class="min-w-full mt-4">
                        <thead>
                            <tr class="bg-gray-200 dark:bg-gray-700">
                                <th class="py-2 text-center">Fournisseur</th>
                                <th class="py-2 text-center">Durée moyenne (jours)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($supplierData as $item)
                            <tr class="border-b">
                                <td class="py-2 text-center">{{ $item['supplier'] }}</td>
                                <td class="py-2 text-center">{{ $item['average_duration'] }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <h3 class="mt-6">État des véhicules</h3>
                    <table class="min-w-full mt-4">
                        <thead>
                            <tr class="bg-gray-200 dark:bg-gray-700">
                                <th class="py-2 text-center">Status</th>
                                <th class="py-2 text-center">Nombre de véhicules</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-b">
                                <td class="py-2 text-center">Maintenance</td>
                                <td class="py-2 text-center">{{ $vehicleStatusCount['maintenance'] }}</td>
                            </tr>
                            <tr class="border-b">
                                <td class="py-2 text-center">Hors service</td>
                                <td class="py-2 text-center">{{ $vehicleStatusCount['out_of_service'] }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @endif
</x-app-layout>
