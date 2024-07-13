<script src="https://kit.fontawesome.com/45e38e596f.js" crossorigin="anonymous"></script>
<x-app-layout>
    <!-- Balise XSLot qui contient le titre de la page -->
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Commander un véhicule') }}
        </h2>
    </x-slot>

    <!-- Bloc principal de la page -->
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <!-- Formulaire pour créer une orders -->
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('orders.store') }}" method="post">
                        <!-- Token de protection CSRF -->
                        @csrf
                        <div class="overflow-x-auto">
                            <!-- Tableau pour afficher les options de sélection -->
                            <table class="table-auto w-full">
                                <thead>
                                    <!-- En-tête du tableau -->
                                    <tr class="bg-gray-100">
                                        <th class="px-4 py-2 text-left">Locataire</th>
                                        <th class="px-4 py-2 text-left">dateDebut</th>
                                        <th class="px-4 py-2 text-left">dateFin</th>
                                        <th class="px-4 py-2 text-left">Véhicule</th>
                                        <th class="px-4 py-2 text-left">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Ligne de formulaire pour ajouter une orders -->
                                    <tr>
                                        <td class="border px-4 py-2">
                                            @if ($errors->has('user_id'))
                                            <div class="text-red-500 font-semibold my-2">
                                                {{ $errors->first('user_id') }}
                                            </div>
                                            @endif
                                            <select name="user_id" id="">
                                                @foreach($users as $user)
                                                    <option value="{{$user->id}}">{{$user->name}}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td class="border px-4 py-2">
                                            @if ($errors->has('start_date'))
                                            <div class="text-red-500 font-semibold my-2">
                                                {{ $errors->first('start_date') }}
                                            </div>
                                            @endif
                                            <input type="date" name="start_date" class="w-full">
                                        </td>
                                        <td class="border px-4 py-2">
                                            @if ($errors->has('end_date'))
                                            <div class="text-red-500 font-semibold my-2">
                                                {{ $errors->first('end_date') }}
                                            </div>
                                            @endif
                                            <input type="date" name="end_date" class="w-full">
                                        </td>
                                        <td class="border px-4 py-2">
                                            @if ($errors->has('vehicle_id'))
                                            <div class="text-red-500 font-semibold my-2">
                                                {{ $errors->first('vehicle_id') }}
                                            </div>
                                            @endif
                                            <select id="vehicleSelect" name="vehicle_id">
                                                @foreach($vehicles as $vehicle)
                                                <option value="{{$vehicle->id}}">{{$vehicle->marque}} {{$vehicle->model}}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <!-- Bouton pour soumettre le formulaire -->
                                        <td class="border px-4 py-2 text-center">
                                            <button class="bg-blue-500 hover:bg-blue-700 text-black font-bold py-2 px-4 rounded">
                                                Enregistrer
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </form>

                    <!-- Pagination pour les utilisateurs -->
                    <div class="pagination mt-3">
                        {{ $users->links() }}
                    </div>

                    <!-- Pagination pour les véhicules -->
                    <div class="pagination mt-3">
                        {{ $vehicles->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
