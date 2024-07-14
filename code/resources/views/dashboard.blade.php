<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('FlexiFleet') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
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
                                <td>{{ $supplier }}</td>
                                <td class="text-center">{{ $count }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <br>
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
                                <td>{{ $supplier }}</td>
                                <td class="text-center">{{ $rate }}%</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>