<style>
    table {
        border: thin solid #000000;
        width: 50%;
        text-align: center;
    }

    td, th {
        border: thin solid #e5e7eb;
        width: 50%;
    }
</style>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Liste des véhicules') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-6">
                <a class="bg-white px-3 py-2 rounded-md hover:bg-slate-200" href="{{ route('vehicles.create') }}">Ajouter un véhicule</a>

                <form action="{{ route('vehicles.index') }}" method="GET" class="flex items-center">
                    <div class="mr-4">
                        <label for="brand" class="mr-2 dark:text-white">Marque:</label>
                        <select name="brand" id="brand" class="px-2 py-1 border rounded-md">
                            <option value="">Toutes</option>
                            @foreach ($brands as $brand)
                                <option value="{{ $brand->marque }}" {{ request('brand') == $brand->marque ? 'selected' : '' }}>
                                    {{ $brand->marque }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mr-4">
                        <label for="sort_km" class="mr-2 dark:text-white">Trier par KM:</label>
                        <select name="sort_km" id="sort_km" class="px-2 py-1 border rounded-md">
                            <option value="">Aucun</option>
                            <option value="asc" {{ request('sort_km') == 'asc' ? 'selected' : '' }}>Croissant</option>
                            <option value="desc" {{ request('sort_km') == 'desc' ? 'selected' : '' }}>Décroissant</option>
                        </select>
                    </div>
                    <div>
                        <button type="submit" class="bg-blue-500 px-3 py-2 rounded-md hover:bg-blue-600 text-white">Filtrer</button>
                    </div>
                </form>
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
                            <th class="px-4 py-2 text-center">Fournisseur</th>
                            <th class="px-4 py-2 text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($vehicles->isEmpty())
                            <tr>
                                <td colspan="7" class="px-4 py-2 text-center">Aucun véhicule à afficher</td>
                            </tr>
                        @else
                            @foreach ($vehicles as $vehicle)
                                <tr class="hover:bg-gray-100">
                                    <td class="px-4 py-2 text-center">{{ $vehicle->marque }}</td>
                                    <td class="px-4 py-2 text-center">{{ $vehicle->model }}</td>
                                    <td class="px-4 py-2 text-center">{{ \Carbon\Carbon::parse($vehicle->last_maintenance)->format('d/m/Y h:i') }}</td>
                                    <td class="px-4 py-2 text-center">{{ $vehicle->nb_kilometrage }} Km</td>
                                    <td class="px-4 py-2 text-center">{{ $vehicle->nb_serie }}</td>
                                    <td class="px-4 py-2 text-center">{{ optional($vehicle->agency)->label ?? 'Aucune agence' }}</td>
                                    <td class="px-4 py-2 text-center">{{ optional($vehicle->supplier)->label ?? 'Aucun fournisseur' }}</td>
                                    <td class="px-4 py-2 text-center">
                                        <a class="bg-blue-500 px-3 py-2 rounded-md hover:bg-blue-600 block mb-2" role="button" href="{{ route('vehicles.edit', ['vehicle' => $vehicle]) }}">Modifier</a>
                                        <form class="m-0 p-2" action="{{ route('vehicles.destroy', ['vehicle' => $vehicle]) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button class="bg-red-500 px-3 py-2 rounded-md hover:bg-red-600" type="submit">Supprimer</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
            <!-- Pagination links -->
            <div class="pagination mt-3">
                {{ $vehicles->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
