<script src="https://kit.fontawesome.com/45e38e596f.js" crossorigin="anonymous"></script>
<x-app-layout>
    <!-- Balise XSLot qui contient le titre de la page -->
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Commande') }}
        </h2>
    </x-slot>

    <!-- Bloc principal de la page -->
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <!-- Formulaire pour créer une commande -->
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('dashboard.commande.store') }}" method="post">
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
                                    <!-- Ligne de formulaire pour ajouter une commande -->
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
                                            @if ($errors->has('fournisseur_id'))
                                                <div class="text-red-500 font-semibold my-2">
                                                    {{ $errors->first('fournisseur_id') }}
                                                </div>
                                            @endif
                                            <select name="fournisseur_id" id="fournisseur" class="w-full">
                                                @foreach ($fournisseur as $fournisseu)
                                                    <option value="{{ $fournisseu->id }}">{{ $fournisseu->label }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td class="border px-4 py-2">
                                            @if ($errors->has('vehicule_id'))
                                                <div class="text-red-500 font-semibold my-2">
                                                    {{ $errors->first('vehicule_id') }}
                                                </div>
                                            @endif
                                            <select name="vehicule_id" id="vehicule" class="w-full">
                                                @foreach ($vehicules as $vehicule)
                                                    @if ($vehicule->status_id == 1)
                                                        <option value="{{ $vehicule->id }}" data-fournisseur-id="{{ $vehicule->fournisseur_id }}">
                                                            {{ $vehicule->marque }} {{ $vehicule->model }}
                                                        </option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </td>
                                        <!-- Liste déroulante pour sélectionner l'utilisateur -->
                                        <td class="border px-4 py-2 text-center">
                                            <select name="users_id">
                                                @foreach ($users as $user)
                                                    <option value="{{ $user->id }}">{{ $user->firstname }}
                                                        {{ $user->lastname }}</option>
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
    const fournisseurSelect = document.getElementById('fournisseur');
    const vehiculeSelect = document.getElementById('vehicule');



    // Fonction qui filtre les véhicules en fonction du fournisseur sélectionné
    function filtrerVehicules() {
        const fournisseurId = fournisseurSelect.value;

        // vehiculeSelect.innerHTML = '';

        // Parcourir toutes les options de véhicules
        for (let i = 0; i < vehiculeSelect.options.length; i++) {
            const option = vehiculeSelect.options[i];

            // Si l'option a une value, on la compare avec l'id du fournisseur
            if (option.value) {
                const vehiculeFournisseurId = option.getAttribute('data-fournisseur-id');
                if (vehiculeFournisseurId === fournisseurId) {
                    // Si le fournisseur est le bon, on affiche l'option
                    option.style.display = '';
                } else {
                    // Sinon, on masque l'option
                    option.style.display = 'none';
                }
            }
        }
    }

    // Ajout de l'événement "change" sur le select "fournisseur"
    fournisseurSelect.addEventListener('change', filtrerVehicules);

    // Filtre initial des véhicules en fonction du fournisseur sélectionné au chargement de la page
    filtrerVehicules();
</script>