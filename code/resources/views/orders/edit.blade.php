<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Modifier une commande') }}
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
                    <form action="{{ route('orders.update', ['order' => $order]) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="overflow-x-auto">
                            <table class="table-auto w-full">
                                <thead>
                                    <tr class="bg-gray-100">
                                        <th class="px-4 py-2 text-left">Locataire</th>
                                        <th class="px-4 py-2 text-left">Email</th>
                                        <th class="px-4 py-2 text-left">Date de début</th>
                                        <th class="px-4 py-2 text-left">Date de fin</th>
                                        <th class="px-4 py-2 text-left">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="px-4 py-2 text-center">
                                            <select name="user_id" id="">
                                                @foreach ($users as $user)
                                                <option value="{{ $user->id }}" {{ $user->id == $order->user_id ? 'selected' : '' }}>
                                                 {{ $user->name }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td class="border px-4 py-2">
                                            <input type="email" name="email" value="{{ old('email', $order->user->email) }}" class="w-full">
                                        </td>
                                        <td class="border px-4 py-2">
                                            <input type="date" name="start_date" value="{{ old('start_date', $order->start_date) }}" class="w-full">
                                        </td>
                                        <td class="border px-4 py-2">
                                            <input type="date" name="end_date" value="{{ old('end_date', $order->end_date) }}" class="w-full">
                                        </td>
                                        <td class="border px-4 py-2 text-center">
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