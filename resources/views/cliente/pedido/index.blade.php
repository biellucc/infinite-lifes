<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Orders') }}
        </h2>
    </x-slot>

    <div class="container">
        @if ($pedidos->isNotEmpty())
            <x-pedido.index :pedidos="$pedidos"></x-pedido.index>
            <div class="d-flex justify-content-center">
                {{ $pedidos->links() }}
            </div>
        @else
            <x-h1 class="mt-5">{{ __('No orders found') }}</x-h1>
        @endif
    </div>
</x-app-layout>
