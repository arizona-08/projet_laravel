<script src="https://kit.fontawesome.com/45e38e596f.js" crossorigin="anonymous"></script>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Ajouter un véhicule') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('vehicles.store') }}" method="post">
                        @csrf
                        <div class="overflow-x-auto">
                            <table class="table-auto w-full">
                                <thead>
                                    <tr class="bg-gray-100">
                                        <th class="px-4 py-2 text-left">Marque</th>
                                        <th class="px-4 py-2 text-left">Modèle</th>
                                        <th class="px-4 py-2 text-left">Dernière maintenance</th>
                                        <th class="px-4 py-2 text-left">Nombre de kilomètres</th>
                                        <th class="px-4 py-2 text-left">Numéro de série</th>
                                        <th class="px-4 py-2 text-left">Status</th>
                                        <th class="px-4 py-2 text-left">Fournisseur</th>
                                        <th class="px-4 py-2 text-left">Agence</th>
                                        <th class="px-4 py-2 text-left">Prix par jour</th>
                                        <th class="px-4 py-2 text-left">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="border px-4 py-2">
                                            @if ($errors->has('marque'))
                                            <div class="text-red-500 font-semibold my-2">
                                                {{ $errors->first('marque') }}
                                            </div>
                                            @endif
                                            <input type="text" name="marque" placeholder="Marque" class="w-full">
                                        </td>
                                        <td class="border px-4 py-2">
                                            @if ($errors->has('model'))
                                            <div class="text-red-500 font-semibold my-2">
                                                {{ $errors->first('model') }}
                                            </div>
                                            @endif
                                            <input type="text" name="model" placeholder="Modèle" class="w-full">
                                        </td>
                                        <td class="border px-4 py-2">
                                            @if ($errors->has('last_maintenance'))
                                            <div class="text-red-500 font-semibold my-2">
                                                {{ $errors->first('last_maintenance') }}
                                            </div>
                                            @endif
                                            <input type="date" name="last_maintenance" class="w-full">
                                        </td>
                                        <td class="border px-4 py-2">
                                            @if ($errors->has('nb_kilometrage'))
                                            <div class="text-red-500 font-semibold my-2">
                                                {{ $errors->first('nb_kilometrage') }}
                                            </div>
                                            @endif
                                            <input type="text" name="nb_kilometrage" placeholder="kilomètres" class="w-full">
                                        </td>
                                        <td class="border px-4 py-2">
                                            @if ($errors->has('nb_serie'))
                                            <div class="text-red-500 font-semibold my-2">
                                                {{ $errors->first('nb_serie') }}
                                            </div>
                                            @endif
                                            <input type="text" name="nb_serie" placeholder="N° de série" class="w-full">
                                        </td>
                                        <td class="border px-4 py-2">
                                            <select name="status_id" class="w-full">
                                                @foreach ($status as $statu)
                                                <option value="{{ $statu->id }}">{{ $statu->label }}</option>
                                                @endforeach
                                            </select>
                                        </td>

                                        <td class="border px-4 py-2">
                                            @if ($errors->has('supplier_id'))
                                            <div class="text-red-500 font-semibold my-2">
                                                {{ $errors->first('supplier_id') }}
                                            </div>
                                            @endif
                                            <select name="supplier_id" class="w-full">
                                                @foreach ($suppliers as $supplier)
                                                <option value="{{ $supplier->id }}">{{ $supplier->label }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td class="border px-4 py-2">
                                            @if ($errors->has('agency_id'))
                                            <div class="text-red-500 font-semibold my-2">
                                                {{ $errors->first('agency_id') }}
                                            </div>
                                            @endif
                                            <select name="agency_id" class="w-full">
                                                @foreach ($agencies as $agency)
                                                <option value="{{ $agency->id }}">{{ $agency->label }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td class="border px-4 py-2">
                                            @if ($errors->has('price_per_day'))
                                            <div class="text-red-500 font-semibold my-2">
                                                {{ $errors->first('price_per_day') }}
                                            </div>
                                            @endif
                                            <input type="number" name="price_per_day" placeholder="Prix par jour" class="w-full">
                                        </td>
                                        <td class="border px-4 py-2">
                                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-black font-bold py-2 px-4 rounded">Ajouter</button>
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