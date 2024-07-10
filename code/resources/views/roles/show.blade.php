<script src="https://kit.fontawesome.com/45e38e596f.js" crossorigin="anonymous"></script>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __("Rôle: $role->name") }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="head mx-auto w-[450px] p-2">
            <p class="dark:text-white">Nombre de {{$role->name}}: {{$role->users_count}}</p>
            
        </div>
        <div class="mx-auto mt-3 w-[450px] bg-white overflow-hidden shadow-sm sm:rounded-lg">
            @if ($role->users)
                <table class="w-full table-auto"> <!-- Définition d'une table -->
                    <thead class="bg-gray-200"> <!-- Définition de l'en-tête de la table -->
                        <tr>
                            <th class="px-4 py-2 text-center">Liste</th> <!-- Titre de la première colonne -->
                        </tr>
                    </thead>
                    <tbody> <!-- Corps de la table -->
                        @foreach ($role->users as $user)
                        <tr>
                            <td class="px-4 py-2 text-center underline"><a href="{{route('users.show', ['user' => $user])}}">{{$user->name}}</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p>Aucun utilisateur n'a ce rôle</p>
            @endif
        </div>
        <div class="foot mx-auto w-[450px] p-2">
            <a href="{{route("users.create", ["role_id" => $role->id])}}" class="bg-blue-500 px-3 py-2 rounded-md hover:bg-blue-600 inline-block mt-2 float-right">Créer un nouveau {{$role->name}}</a>
        </div>
        
    </div>


</x-app-layout>