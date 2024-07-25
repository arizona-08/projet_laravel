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
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Commander un véhicule') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold dark:text-white">Liste des vehicules</h2> <!-- Titre de la section -->
            </div>

            <div class="mt-6 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <table class="w-full">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="px-4 py-2 text-center">Marque</th>
                            <th class="px-4 py-2 text-center">Modèle</th>
                            <th class="px-4 py-2 text-center">Dernière maintenance</th>
                            <th class="px-4 py-2 text-center">Nombre de kilomètres</th>
                            <th class="px-4 py-2 text-center">Numéro de série</th>
                            <th class="px-4 py-2 text-center">Agence</th>
                            <th class="px-4 py-2 text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($availableVehicles->isEmpty())
                        <tr>
                            <td colspan="7" class="px-4 py-2 text-center">Aucun véhicule à afficher</td>
                        </tr>
                        @else
                        @foreach ($availableVehicles as $vehicle)
                        <tr class="hover:bg-gray-100">
                            <td class="px-4 py-2 text-center">{{ $vehicle->marque }}</td>
                            <td class="px-4 py-2 text-center">{{ $vehicle->model }}</td>
                            <td class="px-4 py-2 text-center">{{ \Carbon\Carbon::parse($vehicle->last_maintenance)->format('d/m/Y h:i') }}</td>
                            <td class="px-4 py-2 text-center">{{ $vehicle->nb_kilometrage }} Km</td>
                            <td class="px-4 py-2 text-center">{{ $vehicle->nb_serie }}</td>
                            <td class="px-4 py-2 text-center">{{ optional($vehicle->agency)->label ?? 'Aucune agence' }}</td>
                            <td class="px-4 py-2 text-center">
                                <a class="bg-blue-500 px-3 py-2 rounded-md hover:bg-blue-600 block mb-2" role="button" href="{{ route('customerOrders.show', ['vehicle' => $vehicle]) }}">Commander</a>
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