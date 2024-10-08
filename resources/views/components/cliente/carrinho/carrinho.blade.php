@props(['carrinho'])

<div class="col-md-6 col-lg-12 order-md-last">
    <h4 class="d-flex justify-content-between align-items-center mb-3">
        <span class="text-primary">{{ __('Cart') }}</span>
        <span class="badge bg-primary rounded-pill">{{ $carrinho->livros->count() }}</span>
    </h4>
    <ul class="list-group mb-3">
        @foreach ($carrinho->livros as $livro)
            <li class="list-group-item d-flex justify-content-between lh-sm mb-1">
                <div>
                    <h6 class="my-0">{{ $livro->titulo }}</h6>
                    <small class="text-body-secondary">Idioma: {{ $livro->idioma }}</small>
                    <small class="text-body-secondary">Edição: {{ $livro->edicao }}</small>
                    <small class="text-body-secondary">Vendedor: {{ $livro->vendedor->empresa }}</small>
                    <div class="row">
                        <div class="col-4">
                            <form action="{{ route('pedido.formulario') }}" method="GET">
                                <x-text-input id="tipo_id" class="block mt-1 w-full" type="hidden" name="tipo_id"
                                    :value="'livro'" />
                                <x-text-input id="livro_id" class="block mt-1 w-full" type="hidden" name="livro_id"
                                    :value="$livro->id" />
                                <x-primary-button>{{ __('Order') }}</x-primary-button>
                            </form>
                        </div>

                        <div class="col-4">
                            <form action="{{ route('carrinho.remover') }}" method="GET">
                                <x-text-input id="carrinho_id" class="block mt-1 w-full" type="hidden" name="carrinho_id"
                                    :value="$carrinho->id" />
                                <x-text-input id="livro_id" class="block mt-1 w-full" type="hidden" name="livro_id"
                                    :value="$livro->id" />
                                <x-danger-button>{{ __('Remove') }}</x-danger-button>
                            </form>
                        </div>
                    </div>
                </div>
                <span class="text-body-secondary">R${{ $livro->valor }}</span>
            </li>
        @endforeach
        <li class="list-group-item d-flex justify-content-between">
            <span>Total (Real)</span>
            <strong>R${{ $carrinho->livros->sum('valor') }}</strong>
        </li>

        <form action="{{ route('pedido.formulario') }}" method="get">
            <x-text-input id="tipo_id" class="block mt-1 w-full" type="hidden" name="tipo_id" :value="'carrinho'" />
            <x-text-input id="id" class="block mt-1 w-full" type="hidden" name="id" :value="$carrinho->id" />
            <x-primary-button class="mt-3">{{ __('Order') }}</x-primary-button>
        </form>
    </ul>
</div>
