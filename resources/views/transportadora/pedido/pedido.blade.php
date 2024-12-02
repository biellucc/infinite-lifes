<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Order') }}
        </h2>
    </x-slot>

    <div class="container">
        <x-pedido.pedido :pedido="$pedido"></x-pedido.pedido>
        <x-endereco :endereco="$pedido->carrinho->cliente->usuario->endereco"></x-endereco>

        <div class="mb-3">
            <form action="{{ route('pedido.alterarStatus', $pedido->id) }}" method="post">
                @csrf
                @method('PUT')
                <x-input-label for="status" class="form-label text-primary" :value="__('Status').': '.$pedido->status" />
                <div class="row">
                    <div class="col-4">
                        <x-select class="form-select" id="status" name="status">
                            <option value="Em avaliação">{{ __('Em avaliação') }}</option>
                            <option value="Em trânsito">{{ __('Em trânsito') }}</option>
                            <option value="Entregue">{{ __('Entregue') }}</option>
                        </x-select>
                    </div>
                    <div class="col-5">
                        <x-buttons.alter_button />
                    </div>
                </div>

            </form>
        </div>

        <form action="{{ route('pedido.index') }}" method="get">
            <div class="d-grid mx-auto">
                <x-buttons.close_button class="text-center">{{ __('Back') }}</x-buttons.close_button>
            </div>
        </form>
    </div>
</x-app-layout>
