<script src="https://kit.fontawesome.com/45e38e596f.js" crossorigin="anonymous"></script>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __("Modifier le rôle: $role->name") }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="w-fit mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('roles.update', ['role' => $role]) }}" method="post">
                        @csrf
                        @method("PUT")
                        <div class="overflow-x-auto">
                            <div class="form-container">
                                <div class="input-container mb-3">
                                    @if ($errors->has('name'))
                                        <div class="text-red-500 font-semibold my-2">
                                            {{ $errors->first('name') }}
                                        </div>
                                    @endif
                                    <div class="flex flex-col center">
                                        <label class="block mb-2" for="name">Entrez un nouveau nom de rôle:</label>
                                        <input class="rounded-md focus:outline-none" type="text" id="name" name="name">
                                    </div>
                                </div>
                                
                                <button class="bg-blue-500 px-3 py-2 rounded-md hover:bg-blue-600 block mb-2" type="submit">Enregistrer</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


</x-app-layout>