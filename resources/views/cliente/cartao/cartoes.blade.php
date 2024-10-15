<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Registered Cards') }}
        </h2>
    </x-slot>


    <form action="{{ route('cartao.formulario') }}" method="get">
        <x-primary-button class="ms-3">
            {{ __('Add') }}
        </x-primary-button>
    </form>

    @if ($cartoes->isNotEmpty())
        <div class="container">
            <div class="row">
                @foreach ($cartoes as $cartao)
                    <div class="col-md-5">
                        <x-cliente.cartao.base>
                            <x-slot name="tipo">
                                <h5 class="card-title">{{ $cartao->tipo }}</h5>
                            </x-slot>

                            <x-slot name="numero">
                                <h5 class="card-title">{{ $cartao->numero }}</h5>
                            </x-slot>

                            <x-slot name="validade">
                                <p class="card-text"><strong>{{ __('Validate') }}: </strong>{{ $cartao->validade }}</p>
                            </x-slot>
                        </x-cliente.cartao.base>

                        <div class="d-grid gap-2 col-5 mx-auto shadow">
                            <x-primary-button type="button" data-bs-toggle="modal"
                                data-bs-target="#baseModal{{ $cartao->id }}">{{ __('Informations') }}</x-primary-button>
                        </div>
                    </div>

                    <!-- Modal Contendo Informações do Cartão -->
                    @if ($cartoes->isNotEmpty())
                        <x-modal.baseScroll :id="$cartao->id">
                            <x-slot name="titulo">
                                <x-h1>{{ __('Card') }}</x-h1>
                            </x-slot>

                            <x-slot name="corpo">
                                <form action="{{ route('cartao.atualizar', $cartao->id) }}" method="post">
                                    @csrf
                                    @method('put')
                                    <x-cliente.cartao.base>
                                        <x-slot name="tipo">
                                            <x-select class="form-select" id="tipo" name="tipo">
                                                <option value="credito">Crédito</option>
                                                <option value="debito">Debito</option>
                                            </x-select>
                                            <x-input-error :messages="$errors->get('tipo')" class="mt-2" />
                                        </x-slot>

                                        <x-slot name="numero">
                                            <x-text-input id="numero" class="block mt-1 w-full mt-2" type="text"
                                                name="numero" value="{{ $cartao->numero }}" required
                                                autocomplete="numero" />
                                            <x-input-error :messages="$errors->get('numero')" class="mt-2" />
                                        </x-slot>

                                        <x-slot name="validade">
                                            <x-text-input id="validade" class="block mt-1 w-full mt-2" type="date"
                                                name="validade" value="{{ $cartao->validade }}" required
                                                autocomplete="validade" />
                                            <x-input-error :messages="$errors->get('validade')" class="mt-2" />
                                        </x-slot>
                                    </x-cliente.cartao.base>

                                    <x-slot name="footer">
                                        <x-primary-button>{{ __('Alter') }}</x-primary-button>
                                </form>

                                <form action="{{ route('cartao.deletar', $cartao->id) }}" method="POST">
                                    @csrf
                                    <x-danger-button>{{ __('Delete') }}</x-danger-button>
                                </form>
                            </x-slot>
                            </x-slot>
                        </x-modal.baseScroll>
                    @endif

                @endforeach
            </div>
            <div class="d-flex justify-content-center">
                {{ $cartoes->links() }}
            </div>
        </div>
    @else
        <x-h1 class="mt-5">{{ __('No registered cards found') }}</x-h1>
    @endif


</x-app-layout>
