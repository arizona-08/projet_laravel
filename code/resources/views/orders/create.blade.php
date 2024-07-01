<script src="https://kit.fontawesome.com/45e38e596f.js" crossorigin="anonymous"></script>
<x-app-layout>
    <!-- Balise XSLot qui contient le titre de la page -->
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Order') }}
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
                                        <th class="px-4 py-2 text-left">Prénom</th>
                                        <th class="px-4 py-2 text-left">Nom</th>
                                        <th class="px-4 py-2 text-left">Email</th>
                                        <th class="px-4 py-2 text-left">dateDebut</th>
                                        <th class="px-4 py-2 text-left">dateFin</th>
                                        <th class="px-4 py-2 text-left">Fournisseur</th>
                                        <th class="px-4 py-2 text-left">Véhicule</th>
                                        <th class="px-4 py-2 text-left">Utilisateur</th>
                                        <th class="px-4 py-2 text-left">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Ligne de formulaire pour ajouter une orders -->
                                    <tr>
                                        <td class="border px-4 py-2">
                                            @if ($errors->has('firstname'))
                                                <div class="text-red-500 font-semibold my-2">
                                                    {{ $errors->first('firstname') }}
                                                </div>
                                            @endif
                                            <input type="text" name="firstname" placeholder="Prénom" class="w-full">
                                        </td>
                                        <td class="border px-4 py-2">
                                            @if ($errors->has('lastname'))
                                                <div class="text-red-500 font-semibold my-2">
                                                    {{ $errors->first('lastname') }}
                                                </div>
                                            @endif
                                            <input type="text" name="lastname" placeholder="Nom" class="w-full">
                                        </td>
                                        <td class="border px-4 py-2">
                                            @if ($errors->has('email'))
                                                <div class="text-red-500 font-semibold my-2">
                                                    {{ $errors->first('email') }}
                                                </div>
                                            @endif
                                            <input type="text" name="email" placeholder="Email" class="w-full h-12">
                                        </td>
                                        <td class="border px-4 py-2">
                                            @if ($errors->has('dateDebut'))
                                                <div class="text-red-500 font-semibold my-2">
                                                    {{ $errors->first('dateDebut') }}
                                                </div>
                                            @endif
                                            <input type="date" name="dateDebut" class="w-full">
                                        </td>
                                        <td class="border px-4 py-2">
                                            @if ($errors->has('dateFin'))
                                                <div class="text-red-500 font-semibold my-2">
                                                    {{ $errors->first('dateFin') }}
                                                </div>
                                            @endif
                                            <input type="date" name="dateFin" class="w-full">
                                        </td>
                                        <td class="border px-4 py-2">
                                            @if ($errors->has('supplier_id'))
                                                <div class="text-red-500 font-semibold my-2">
                                                    {{ $errors->first('supplier_id') }}
                                                </div>
                                            @endif
                                            <select name="supplier_id" id="supplier" class="w-full">
                                                @foreach ($supplier as $suppliers)
                                                    <option value="{{ $supplier->id }}">{{ $supplier->label }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td class="border px-4 py-2">
                                            @if ($errors->has('vehicle_id'))
                                                <div class="text-red-500 font-semibold my-2">
                                                    {{ $errors->first('vehicle_id') }}
                                                </div>
                                            @endif
                                            <select name="vehicle_id" id="vehicle" class="w-full">
                                                @foreach ($vehicles as $vehicle)
                                                    @if ($vehicle->status_id == 1)
                                                        <option value="{{ $vehicle->id }}" data-supplier-id="{{ $vehicle->supplier_id }}">
                                                            {{ $vehicle->marque }} {{ $vehicle->model }}
                                                        </option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </td>
                                        <!-- Liste déroulante pour sélectionner l'utilisateur -->
                                        <td class="border px-4 py-2 text-center">
                                            <select name="users_id">
                                                @foreach ($users as $user)
                                                    <option value="{{ $user->id }}">{{ $user->name }}
                                                        {{ $user->email }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <!-- Bouton pour soumettre le formulaire -->
                                        <td class="border px-4 py-2 text-center">
                                            <button
                                                class="bg-blue-500 hover:bg-blue-700 text-black font-bold py-2 px-4 rounded">
                                                Enregistrer
                                            </button>
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




<script>
    // Récupération des éléments du DOM
    const supplierSelect = document.getElementById('supplier');
    const vehicleSelect = document.getElementById('vehicle');



    // Fonction qui filtre les véhicules en fonction du supplier sélectionné
    function filtrerVehicules() {
        const supplierId = supplierSelect.value;

        // vehicleSelect.innerHTML = '';

        // Parcourir toutes les options de véhicules
        for (let i = 0; i < vehicleSelect.options.length; i++) {
            const option = vehicleSelect.options[i];

            // Si l'option a une value, on la compare avec l'id du supplier
            if (option.value) {
                const vehicleSupplierID = option.getAttribute('data-supplier-id');
                if (vehicleSupplierId === SupplierID) {
                    // Si le supplier est le bon, on affiche l'option
                    option.style.display = '';
                } else {
                    // Sinon, on masque l'option
                    option.style.display = 'none';
                }
            }
        }
    }

    // Ajout de l'événement "change" sur le select "supplier"
    supplierSelect.addEventListener('change', filtrerVehicules);

    // Filtre initial des véhicules en fonction du supplier sélectionné au chargement de la page
    filtrerVehicules();
</script>