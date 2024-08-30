<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Cart') }}
        </h2>
    </x-slot>

    <div class="container">
        @if ($carrinhos->isNotEmpty())
            @foreach ($carrinhos as $carrinho)
                <x-carrinho :carrinho="$carrinho"></x-carrinho>
            @endforeach
        @else
        <x-h1 class="mt-5">{{ __('No cart found') }}</x-h1>
        @endif
    </div>
</x-app-layout>
