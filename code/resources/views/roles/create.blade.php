<script src="https://kit.fontawesome.com/45e38e596f.js" crossorigin="anonymous"></script>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Ajouter un rôle') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('roles.store') }}" method="post">
                        @csrf
                        <div class="overflow-x-auto">
                            <div class="form-container">
                                <div class="input-container">
                                    @if ($errors->has('name'))
                                        <div class="text-red-500 font-semibold my-2">
                                            {{ $errors->first('name') }}
                                        </div>
                                    @endif
                                    <input type="text" name="name">
                                </div>
                                
                                <button type="submit">Créer</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


</x-app-layout>