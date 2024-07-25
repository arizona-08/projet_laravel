<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Modification de:') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
              @if ($errors->any())
                <div class="alert alert-danger">
                  <ul>
                    @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                    @endforeach
                  </ul>
                </div>
              @endif
              <form action="{{ route('vehicles.update', ['vehicle' => $vehicle]) }}" method="post">
                @csrf
                @method('PUT')
                <div class="overflow-x-auto">
                  <table class="table-auto w-full">
                    <thead>
                      <tr class="bg-gray-100">
                        <th class="px-4 py-2 text-left">Modèle</th>
                        <th class="px-4 py-2 text-left">Marque</th>
                        <th class="px-4 py-2 text-left">Dernière maintenance</th>
                        <th class="px-4 py-2 text-left">Nombre de kilomètres</th>
                        <th class="px-4 py-2 text-left">Numéro de série</th>
                        <th class="px-4 py-2 text-left">Status</th>
                        <th class="px-4 py-2 text-left">Agences</th>
                        <th class="px-4 py-2 text-left">Fournisseurs</th>
                        <th class="px-4 py-2 text-left">Prix par jour</th>
                        <th class="px-4 py-2 text-left">Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td class="border px-4 py-2"><input type="text" name="model" placeholder="Modèle" value="{{ $vehicle->model }}" class="w-full"></td>
                        <td class="border px-4 py-2"><input type="text" name="marque" placeholder="Marque" value="{{ $vehicle->marque }}" class="w-full"></td>
                        <td class="border px-4 py-2"><input type="date" name="last_maintenance" value="{{ \Carbon\Carbon::parse($vehicle->last_maintenance)->format('Y-m-d') }}" class="w-full"></td>
                        <td class="border px-4 py-2"><input type="text" name="nb_kilometrage" placeholder="kilomètres" value="{{ $vehicle->nb_kilometrage }}" class="w-full"></td>
                        <td class="border px-4 py-2"><input type="text" name="nb_serie" placeholder="N° de série" value="{{ $vehicle->nb_serie }}" class="w-full"></td>
                        <td class="border px-4 py-2">
                            <select name="status_id" id="" class="w-full">
                                @foreach ($status as $statu )
                                    <option value="{{ $statu->id }}">{{ $statu->label }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td class="border px-4 py-2">
                            <select name="agency_id" id="" class="w-full">
                                @foreach ($agencies as $agency )
                                    <option value="{{ $agency->id }}">{{ $agency->label }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td class="border px-4 py-2">
                            <select name="supplier_id" id="" class="w-full">
                                @foreach ($suppliers as $supplier )
                                    <option value="{{ $supplier->id }}">{{ $supplier->label }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td class="border px-4 py-2"><input type="text" name="price_per_day" placeholder="Prix par jour" value="{{ $vehicle->price_per_day }}" class="w-full"></td>
                        <td class="border px-4 py-2">
                          <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-black font-bold py-2 px-4 rounded">Valider</button>
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
