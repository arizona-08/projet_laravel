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

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                @if (Auth::user()->role_id == 1 || Auth::user()->role_id == 2 || Auth::user()->role_id == 3 || Auth::user()->role_id == 4)
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3>Nombre de véhicules loués par fournisseur</h3>
                    <table class="min-w-full">
                        <thead>
                            <tr>
                                <th class="text-center">Fournisseur</th>
                                <th class="text-center">Nombre de véhicules loués</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($vehiclesRentedCount as $supplier => $count)
                            <tr>
                                <td class="text-center">{{ $supplier }}</td>
                                <td class="text-center">{{ $count }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <h3 class="mt-6">Taux de disponibilité des véhicules par fournisseur</h3>
                    <table class="min-w-full">
                        <thead>
                            <tr>
                                <th class="text-center">Fournisseur</th>
                                <th class="text-center">Taux de disponibilité</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($availabilityRate as $supplier => $rate)
                            <tr>
                                <td class="text-center">{{ $supplier }}</td>
                                <td class="text-center">{{ $rate }}%</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <h3 class="mt-6">Revenu total par fournisseur</h3>
                    <table class="min-w-full">
                        <thead>
                            <tr>
                                <th class="text-center">Fournisseur</th>
                                <th class="text-center">Revenu total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($totalRevenueBySupplier as $supplier => $revenue)
                            <tr>
                                <td class="text-center">{{ $supplier }}</td>
                                <td class="text-center">{{ $revenue }} €</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <h3 class="mt-6">Revenu moyen par location</h3>
                    <table class="min-w-full">
                        <thead>
                            <tr>
                                <th class="text-center">Fournisseur</th>
                                <th class="text-center">Revenu moyen</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($averageRevenuePerRental as $supplier => $averageRevenue)
                            <tr>
                                <td class="text-center">{{ $supplier }}</td>
                                <td class="text-center">{{ $averageRevenue }} €</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <h3 class="mt-6">Durée moyenne des locations</h3>
                    <table class="min-w-full">
                        <thead>
                            <tr>
                                <th class="text-center">Fournisseur</th>
                                <th class="text-center">Durée moyenne (jours)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($averageRentalDuration as $supplier => $averageDuration)
                            <tr>
                                <td class="text-center">{{ $supplier }}</td>
                                <td class="text-center">{{ $averageDuration }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <h3 class="mt-6">État des véhicules</h3>
                    <table class="min-w-full">
                        <thead>
                            <tr>
                                <th class="text-center">Status</th>
                                <th class="text-center">Nombre de véhicules</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-center">Maintenance</td>
                                <td class="text-center">{{ $vehicleStatusCount['maintenance'] }}</td>
                            </tr>
                            <tr>
                                <td class="text-center">Hors service</td>
                                <td class="text-center">{{ $vehicleStatusCount['out_of_service'] }}</td>
                            </tr>
                        </tbody>
                    </table>

                    <h3 class="mt-6">Demande par type de véhicule</h3>
                    <table class="min-w-full">
                        <thead>
                            <tr>
                                <th class="text-center">Type de véhicule</th>
                                <th class="text-center">Demande</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($demandByVehicleType as $supplier => $demands)
                            @foreach ($demands as $model => $count)
                            <tr>
                                <td class="text-center">{{ $model }}</td>
                                <td class="text-center">{{ $count }}</td>
                            </tr>
                            @endforeach
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>