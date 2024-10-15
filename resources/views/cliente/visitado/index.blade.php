<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Visiteds') }}
        </h2>
    </x-slot>

    <div class="container">
        @if ($visitados->isNotEmpty())
            <x-cliente.visitado.index :visitados="$visitados"></x-cliente.visitado.index>
            <div class="d-flex justify-content-center">
                {{ $visitados->links() }}
            </div>
        @else
            <x-h1 class="mt-5">{{ __('No visited found') }}</x-h1>
        @endif
    </div>
</x-app-layout>
