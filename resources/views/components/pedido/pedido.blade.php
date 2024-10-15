@props(['pedido'])
<div class="col-md-6 col-lg-12 order-md-last">
    <h4 class="d-flex justify-content-between align-items-center mb-3">
        <span class="text-primary">{{ __('Order') }}: {{ $pedido->status }}</span>
        <span class="badge bg-primary rounded-pill">{{ $pedido->carrinho->livros->count() }}</span>
    </h4>
    <ul class="list-group mb-3">
        @foreach ($pedido->carrinho->livros as $livro)
            <li class="list-group-item d-flex justify-content-between lh-sm mb-1">
                <div>
                    <h6 class="my-0">{{ $livro->titulo }}</h6>
                    <small class="text-body-secondary">{{ __('Language') }}: {{ $livro->idioma }}</small>
                    <small class="text-body-secondary">{{ __('Edition') }}: {{ $livro->edicao }}</small>
                    <small class="text-body-secondary">{{ __('Company') }}: {{ $livro->vendedor->empresa }}</small>
                </div>
                @if (Auth::user()->cliente)
                    <span class="text-body-secondary">R${{ $livro->valor }}</span>
                @endif
            </li>
        @endforeach
        @if (Auth::user()->cliente)
            <li class="list-group-item d-flex justify-content-between">
                <span>Total (Real)</span>
                <strong>R${{ $pedido->valor }}</strong>
                <span>{{ __('Carrier') }}</span>
                <strong>{{ $pedido->transportadora->empresa }}</strong>
            </li>
        @endif
    </ul>
</div>
