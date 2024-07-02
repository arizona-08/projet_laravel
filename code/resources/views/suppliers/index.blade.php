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
            {{ __('Liste des fournisseurs') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="flex justify-between items-center">
            <a class="bg-white px-3 py-2 rounded-md hover:bg-slate-200" href="{{ route('suppliers.create') }}">Ajouter un fournisseur</a>
          </div>
          <div class="mt-6 bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <table class="w-full">
              <thead class="bg-gray-200">
                <tr>
                  <th class="px-4 py-2 text-center">Nom du fournisseur</th>
                  <th class="px-4 py-2 text-center">Véhicule</th>

                  <th class="px-4 py-2 text-center">Action</th>
                </tr>
              </thead>
              <tbody>
                @if ($suppliers->isEmpty())
                    <tr>
                        <td colspan="9" class="px-4 py-2 text-center">Aucun fournisseur à afficher</td>
                    </tr>
                @else
                @foreach ($suppliers as $supplier) <!-- Boucle pour chaque fournisseur -->
                    <tr class="hover:bg-gray-100"> <!-- Ligne du tableau pour chaque fournisseur -->
                        <td class="px-4 py-2 text-center">{{ $supplier->label }}</td> <!-- Colonne pour le nom du fournisseur -->
                        <td class="px-4 py-2 text-center">
                            <a href="" class="btn btn-light">Voir les véhicules</a> <!-- Bouton pour voir les véhicules du fournisseur -->
                        </td>
                        <td class="text-center">
                            <a class="btn btn-light btn-block" role="button" href="{{ route('suppliers.edit', ['supplier' => $supplier]) }}">Modifier</a> <!-- Bouton pour modifier le fournisseur -->
                            <form class="m-0 p-2" action="{{ route('suppliers.destroy', ['supplier' => $supplier]) }}" method="post">
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
        </div>
      </div>
</x-app-layout>
