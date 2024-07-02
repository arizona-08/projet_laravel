<x-app-layout>
    <!-- Le nom du fournisseur est affiché dans cette section -->
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Fournisseur') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('suppliers.store') }}" method="post">
                        @csrf
                        <!-- Le tableau affiche les informations sur les fournisseurs -->
                        <div class="overflow-x-auto">
                            <table class="table-auto w-full">
                                <thead>
                                    <!-- La première ligne du tableau affiche les noms des colonnes -->
                                    <tr class="bg-gray-100">
                                        <th class="px-4 py-2 text-center">Nom du fournisseur</th>
                                        <th class="px-4 py-2 text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>

                                        <!-- L'utilisateur peut saisir le nom du fournisseur dans cette cellule -->
                                        <td class="border px-4 py-2 text-center">
                                            @if ($errors->has('label'))
                                                <div class="text-red-500 font-semibold my-2">
                                                {{ $errors->first('label') }}
                                                </div>
                                            @endif
                                            <input type="text" name="label" placeholder="Nom du fournisseur" class="w-full"></td>
                                        <td class="border px-4 py-2 text-center">
                                            <!-- L'utilisateur peut ajouter un nouveau fournisseur en cliquant sur le bouton Ajouter -->
                                            <button type="submit"
                                                class="bg-blue-500 hover:bg-blue-700 text-black font-bold py-2 px-4 rounded">Ajouter</button>
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
