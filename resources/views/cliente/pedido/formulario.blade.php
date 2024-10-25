<x-app-layout>
    <div class="container">
        <main>
            <div class="py-5 text-center">
                <h2>{{ __('Order') }}</h2>
            </div>

            <div class="row g-5">
                <div class="col-md-5 col-lg-4 order-md-last">
                    <h4 class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-primary">{{ __('Your cart') }}</span>
                        <span class="badge bg-primary rounded-pill">{{ $carrinho->livros->count() }}</span>
                    </h4>
                    <ul class="list-group mb-3">
                        @foreach ($carrinho->livros as $livro)
                            <li class="list-group-item d-flex justify-content-between lh-sm">
                                <div>
                                    <h6 class="my-0">{{ $livro->titulo }}</h6>
                                    <small class="text-body-secondary">Idioma: {{ $livro->idioma }}</small>
                                    <small class="text-body-secondary">Edição: {{ $livro->edicao }}</small>
                                    <small class="text-body-secondary">Vendedor: {{ $livro->vendedor->empresa }}</small>
                                </div>
                                <span class="text-body-secondary">R${{ $livro->valor }}</span>
                            </li>
                        @endforeach
                        <li class="list-group-item d-flex justify-content-between">
                            <span>Total (Real)</span>
                            <strong>R${{ $carrinho->livros->sum('valor') }}</strong>
                        </li>
                    </ul>
                </div>

                <div class="col-md-7 col-lg-8">
                    <h4 class="mb-3">Endereço de cobrança</h4>
                    <form action="{{ route('pedido.cadastrar') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row g-3">
                            <div class="col-sm-6">
                                <x-input-label for="nome" :value="__('Name')" />
                                <x-text-input id="nome" class="block mt-1 w-full" type="text" name="nome"
                                    value="{{ $carrinho->cliente->nome }}" autofocus autocomplete="nome" />
                                <x-input-error :messages="$errors->get('nome')" class="mt-2" />
                            </div>

                            <div class="col-sm-6">
                                <x-input-label for="sobrenome" :value="__('Last Name')" />
                                <x-text-input id="sobrenome" class="block mt-1 w-full" type="text" name="sobrenome"
                                    value="{{ $carrinho->cliente->sobrenome }}" autocomplete="sobrenome" />
                                <x-input-error :messages="$errors->get('sobrenome')" class="mt-2" />
                            </div>


                            <div class="col-8">
                                <x-input-label for="email" :value="__('Email')" />
                                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                                    value="{{ $carrinho->cliente->usuario?->email }}" autocomplete="email" />
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>

                            <div class="col-4">
                                <x-input-label for="telefone" :value="__('Phone Number')" />
                                <x-text-input id="telefone" class="block mt-1 w-full" type="text" name="telefone"
                                    value="{{ $carrinho->cliente->usuario?->telefone }}" autocomplete="telefone" />
                                <x-input-error :messages="$errors->get('telefone')" class="mt-2" />
                            </div>

                            <div class="col-md-3">
                                <x-input-label for="cep" :value="__('CEP')" />
                                <x-text-input id="cep" class="block mt-1 w-full" type="text" name="cep"
                                    value="{{ $carrinho->cliente->usuario?->endereco?->cep }}" autocomplete="cep" />
                                <x-input-error :messages="$errors->get('cep')" class="mt-2" />
                            </div>

                            <div class="col-md-5">
                                <x-input-label for="pais" :value="__('endereco.Country')" />
                                <x-text-input id="pais" class="block mt-1 w-full" type="text" name="pais"
                                    value="{{ $carrinho->cliente->usuario?->endereco?->pais }}" autocomplete="pais" />
                                <x-input-error :messages="$errors->get('pais')" class="mt-2" />
                            </div>

                            <div class="col-md-4">
                                <x-input-label for="estado" :value="__('endereco.State')" />
                                <x-text-input id="estado" class="block mt-1 w-full" type="text" name="estado"
                                    value="{{ $carrinho->cliente->usuario?->endereco?->estado }}"
                                    autocomplete="estado" />
                                <x-input-error :messages="$errors->get('estado')" class="mt-2" />
                            </div>

                            <div class="col-md-5">
                                <x-input-label for="cidade" :value="__('endereco.City')" />
                                <x-text-input id="cidade" class="block mt-1 w-full" type="text" name="cidade"
                                    value="{{ $carrinho->cliente->usuario?->endereco?->estado }}"
                                    autocomplete="cidade" />
                                <x-input-error :messages="$errors->get('cidade')" class="mt-2" />
                            </div>

                            <div class="col-md-7">
                                <x-input-label for="bairro" :value="__('endereco.Neighborhood')" />
                                <x-text-input id="bairro" class="block mt-1 w-full" type="text" name="bairro"
                                    value="{{ $carrinho->cliente->usuario?->endereco?->bairro }}"
                                    autocomplete="bairro" />
                                <x-input-error :messages="$errors->get('bairro')" class="mt-2" />
                            </div>

                            <div class="col-md-12">
                                <x-input-label for="endereco" :value="__('endereco.Address')" />
                                <x-text-input id="endereco" class="block mt-1 w-full" type="text"
                                    name="endereco" value="{{ $carrinho->cliente->usuario?->endereco?->endereco }}"
                                    autocomplete="endereco" />
                                <x-input-error :messages="$errors->get('endereco')" class="mt-2" />
                            </div>

                            <div class="col-md-12">
                                <x-input-label for="complemento" :value="__('Complement')" />
                                <x-text-input id="complemento" class="block mt-1 w-full" type="text"
                                    name="complemento"
                                    value="{{ $carrinho->cliente->usuario?->endereco?->complemento }}"
                                    autocomplete="complemento" />
                                <x-input-error :messages="$errors->get('complemento')" class="mt-2" />
                            </div>

                            <div class="col-md-6">
                                <x-input-label for="cartao" class="form-label" :value="__('Card')" />
                                <x-select class="form-select" id="cartao" name="cartao">
                                    @foreach ($cartoes as $cartao)
                                        <option value="{{ $cartao->id }}">{{ __('Number') }}:
                                            {{ $cartao->numero }}</option>
                                    @endforeach
                                </x-select>
                                <x-input-error :messages="$errors->get('cartao')" class="mt-2" />
                            </div>

                            <hr class="my-4">

                            <x-text-input id="tipo_id" class="block mt-1 w-full" type="hidden" name="carrinho_id"
                                value="{{ $carrinho->id }}" />
                            <x-text-input id="tipo_id" class="block mt-1 w-full" type="hidden" name="valor"
                                value="{{ $carrinho->livros->sum('valor') }}" />
                            <x-primary-button>{{ __('Order') }}</x-primary-button>
                        </div>
                    </form>

                    <form action="{{ route('carrinho.index') }}" method="GET">
                        <div class="d-flex justify-content-center container my-1">
                            <div class="d-grid gap-2 col-12 mx-auto shadow">
                                <x-buttons.close_button valor="Back"/>
                            </div>
                        </div>
                    </form>
                </div>

            </div>

        </main>
    </div>
</x-app-layout>
