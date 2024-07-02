<x-app-layout>
    <!-- Slot pour le header de la page -->
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Fournisseur') }}
        </h2>
    </x-slot>


    <!-- Section principale de la page -->
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Conteneur pour la partie principale de la page -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- Afficher les erreurs de validation si elles existent -->
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Formulaire pour la modification du fournisseur -->
                    <form action="{{ route('suppliers.update', ['supplier' => $suppliers->id]) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="overflow-x-auto">
                            <!-- Tableau pour afficher les données à modifier -->
                            <table class="table-auto w-full">
                                <thead>
                                    <tr class="bg-gray-100">
                                        <th class="px-4 py-2 text-left">Nom du fournisseur</th>
                                        <th class="px-4 py-2 text-left">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <!-- Champ pour modifier le nom du fournisseur -->
                                        <td class="border px-4 py-2">
                                            <input type="text" name="label" placeholder="Nom du fournisseur"
                                                value="{{ $suppliers->label }}" class="w-full">
                                        </td>

                                        <!-- Bouton pour valider la modification -->
                                        <td class="border px-4 py-2 text-center">
                                            <button type="submit"
                                                class="bg-blue-500 hover:bg-blue-700 text-black font-bold py-2 px-4 rounded">Valider</button>
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
