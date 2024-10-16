@props(['pedidos'])
<div class="col-md-6 col-lg-12 order-md-last">
    <ul class="list-group mb-3">
        <h4 class="d-flex justify-content-between align-items-center mb-3">
            @if (Auth::user()->cliente)
                <span class="text-primary">{{ __('Your orders') }}</span>
            @elseif(Auth::user()->transportadora)
                <span class="text-primary">{{ __('Orders') }}</span>
            @endif
            <span class="badge bg-primary rounded-pill">{{ $pedidos->count() }}</span>
        </h4>
        @foreach ($pedidos as $pedido)
            <li class="list-group-item d-flex justify-content-between lh-sm mt-1">
                <div>
                    <small class="text-body-secondary">{{ __('Status') }}: {{ $pedido->status }}</small>
                    @if (Auth::user()->cliente)
                        <small class="text-body-secondary">{{ __('Carrier') }}:
                            {{ $pedido->transportadora->empresa }}</small>
                    @endif
                    <div class="row">
                        <div class="col-4">
                            <form action="{{ route('pedido.pedido', ['id' => $pedido->id]) }}" method="GET">
                                <x-buttons.information_button  valor="Open" />
                            </form>
                        </div>
                    </div>
                </div>

                @if (Auth::user()->cliente)
                    <span class="text-body-secondary">R${{ $pedido->valor }}</span>
                @endif
            </li>
        @endforeach
    </ul>
</div>
