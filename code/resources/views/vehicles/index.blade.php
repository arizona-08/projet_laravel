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
          <div class="flex justify-between items-center">
            <a class="bg-white px-3 py-2 rounded-md hover:bg-slate-200" href="{{ route('vehicles.create') }}">Ajouter un véhicule</a>
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
                  {{-- <th class="px-4 py-2 text-center">Statut</th>
                  <th class="px-4 py-2 text-center">Agence</th>
                  <th class="px-4 py-2 text-center">Fournisseur</th> --}}

                  <th class="px-4 py-2 text-center">Action</th>
                </tr>
              </thead>
              <tbody>
                @if ($vehicles->isEmpty())
                  <tr>
                    <td colspan="9" class="px-4 py-2 text-center">Aucun véhicule à afficher</td>
                  </tr>
                @else
                @foreach ($vehicles as $vehicle)
                  <tr class="hover:bg-gray-100">
                    <td class="px-4 py-2 text-center">{{ $vehicle->marque }}</td>
                    <td class="px-4 py-2 text-center">{{ $vehicle->model }}</td>
                    <td class="px-4 py-2 text-center">{{ \Carbon\Carbon::parse($vehicle->last_maintenance)->format('d/m/Y h:i') }}</td>
                    <td class="px-4 py-2 text-center">{{ $vehicle->nb_kilometrage }} Km</td>
                    <td class="px-4 py-2 text-center">{{ $vehicle->nb_serie }}</td>
                    {{-- <td class="px-4 py-2 text-center">{{ $vehicle->status->label }}</td>
                    <td class="px-4 py-2 text-center">{{ $vehicle->agence->label }}</td>
                    <td class="px-4 py-2 text-center">{{ $vehicle->fournisseur->label }}</td> --}}
                    <td class="text-center">
                      <a class="block p-2 bg-blue-500 text-white" role="button" href="{{ route('vehicles.edit', ['vehicle' => $vehicle]) }}">Modifier</a>
                      <form action="{{ route('vehicles.destroy', ['vehicle' => $vehicle]) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button class="block p-2 bg-red-500 text-white" type="submit">Supprimer</button>
                      </form>
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