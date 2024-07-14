<script src="https://kit.fontawesome.com/45e38e596f.js" crossorigin="anonymous"></script>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Détail du véhicule') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <a href="{{ route('agencies.show', ['agency' => $vehicle->agency->id]) }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded inline-block mb-4">
                <i class="fas fa-arrow-left mr-2"></i>Retour à la liste des véhicules
            </a>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="mb-4">
                        <strong>Marque:</strong> {{ $vehicle->marque }}
                    </div>
                    <div class="mb-4">
                        <strong>Modèle:</strong> {{ $vehicle->model }}
                    </div>
                    <div class="mb-4">
                        <strong>Dernière maintenance:</strong> {{ $vehicle->last_maintenance }}
                    </div>
                    <div class="mb-4">
                        <strong>Kilométrage:</strong> {{ $vehicle->nb_kilometrage }}
                    </div>
                    <div class="mb-4">
                        <strong>Numéro de série:</strong> {{ $vehicle->nb_serie }}
                    </div>
                    <div class="mb-4">
                        <strong>Statut:</strong> {{ $vehicle->status->label }}
                    </div>
                    <div class="mb-4">
                        <strong>Agence:</strong> {{ $vehicle->agency->label }}
                    </div>
                    <div class="mb-4">
                        <strong>Fournisseur:</strong> {{ $vehicle->supplier->label }}
                    </div>
                    <div class="mt-4 flex space-x-4">
                        <a class="bg-blue-500 w-32 text-center block px-3 py-2 rounded-md hover:bg-blue-600 text-white" role="button" href="{{ route('vehicles.edit', ['vehicle' => $vehicle]) }}">Modifier</a>
                        <form action="{{ route('vehicles.destroy', ['vehicle' => $vehicle]) }}" method="post" class="m-0">
                            @csrf
                            @method('DELETE')
                            <button class="bg-red-500 w-32 text-center block px-3 py-2 rounded-md hover:bg-red-600 text-white" type="submit">Supprimer</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
