<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Favorites') }}
        </h2>
    </x-slot>

    <div class="container">
        @if ($favoritos->isNotEmpty())
            <x-cliente.favorito.favorito :favoritos="$favoritos"></x-cliente.favorito.favorito>
        @else
            <x-h1 class="mt-5">{{ __('No favorites found') }}</x-h1>
        @endif
    </div>
</x-app-layout>
