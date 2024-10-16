<x-app-layout>
    <div class="container">
        <x-livro.livro_informacoes :livro="$livro">
            <x-slot name="botoes">
                <div class="col-4">
                    @php
                        if (Auth::check() && Auth::user()->cliente) {
                            $cliente = Auth::user()->cliente;
                            $carrinho = $cliente->carrinhos->firstWhere('status', 1);
                            if ($carrinho != null) {
                                $temNoCarrinho = $carrinho
                                    ->livros()
                                    ->where('livro_id', $livro->id)
                                    ->first();
                            } else {
                                $temNoCarrinho = null;
                            }

                            $favorito = $cliente->favoritos->firstWhere('livro_id', $livro->id);
                            //dd($favorito);
                        } else {
                            $temNoCarrinho = null;
                            $favorito = null;
                        }
                    @endphp

                    @if ($temNoCarrinho == null)
                        @if ($livro->estoque > 0)
                            <form action="{{ route('carrinho.adicionar') }}" method="post">
                                @csrf
                                <x-text-input id="livro_id" class="block mt-1 w-full" type="hidden" name="livro_id"
                                    :value="$livro->id" />
                                <x-buttons.cart_button />
                            </form>
                        @else
                            <x-primary-button disabled>{{ __('Sold out') }}</x-primary-button>
                        @endif
                    @else
                        <form action="{{ route('carrinho.remover') }}" method="GET">
                            @csrf
                            <x-text-input id="carrinho_id" class="block mt-1 w-full" type="hidden" name="carrinho_id"
                                :value="$carrinho->id" />
                            <x-text-input id="livro_id" class="block mt-1 w-full" type="hidden" name="livro_id"
                                :value="$livro->id" />
                            <x-buttons.cart_button valor="Remove from cart" />
                        </form>
                    @endif
                </div>
                <div class="col-4">
                    @if ($favorito == null)
                        <form action="{{ route('favorito.adicionar') }}" method="POST">
                            @csrf
                            <x-text-input id="livro_id" class="block mt-1 w-full" type="hidden" name="livro_id"
                                :value="$livro->id" />
                            <x-buttons.favorite_button />
                        </form>
                    @else
                        <form action="{{ route('favorito.remover') }}" method="GET">
                            <x-text-input id="favorito_id" class="block mt-1 w-full" type="hidden" name="favorito_id"
                                :value="$favorito->id" />
                            <x-buttons.favorite_button valor="Unfavorite" />
                        </form>
                    @endif
                </div>
                <div class="col-4">
                    <form action="{{ route('pedido.formulario') }}" method="GET">
                        @csrf
                        <x-text-input id="tipo_id" class="block mt-1 w-full" type="hidden" name="tipo_id"
                            :value="'livro'" />
                        <x-text-input id="livro_id" class="block mt-1 w-full" type="hidden" name="livro_id"
                            :value="$livro->id" />
                        <x-primary-button>{{ __('Order') }}</x-primary-button>
                    </form>
                </div>
            </x-slot>
        </x-livro.livro_informacoes>
        <div class="border-bottom border-light-subtle">
            <h5><strong>{{ __('Comments') }}</strong></h5>
        </div>

        <x-buttons.add_button class="mt-1" type="button" data-bs-toggle="modal" data-bs-target="#storeModal"  valor="Comment" />

        @if ($comentarios->isNotEmpty())
            <x-livro.comentario :comentarios="$comentarios"></x-livro.comentario>
        @endif
    </div>

    <!-- Modal Comments -->
    <form action="{{ route('comentario.store') }}" method="post">
        @csrf
        <x-modal.storeScroll>
            <x-slot name="titulo">{{ __('Store Comment') }}</x-slot>
            <x-slot name="corpo">
                <div>
                    <x-textarea id="corpo" class="block mt-1 w-full form-control" type="text" name="corpo"
                        required />
                    <x-input-error :messages="$errors->get('corpo')" class="mt-2" />
                </div>
                <x-text-input id="livro_id" class="block mt-1 w-full" type="hidden" name="livro_id" :value="$livro->id"
                    required />
            </x-slot>
            <x-slot name="footer">
                <x-buttons.add_button />
            </x-slot>
        </x-modal.storeScroll>
    </form>
</x-app-layout>
