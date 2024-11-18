@props(['comentarios'])
<div class="col-md-6 col-lg-12 order-md-last">
    <ul class="list-group mt-3">
        @foreach ($comentarios as $comentario)
            <li class="list-group-item d-flex justify-content-between lh-sm mb-3">
                <div>
                    <p class="text-body-secondary">{{ $comentario->cliente->nome }}
                        {{ $comentario->cliente->sobrenome }}</p>
                    <p class="text-body-secondary">{{ $comentario->corpo }}</p>
                    <small class="text-body-secondary">{{ $comentario->updated_at }}</small>

                    @if (Auth::check() && Auth::user()->cliente && $comentario->cliente_id == Auth::user()->cliente->id)
                        <div class="row mt-2">
                            <div class="col-4 me-4">
                                <x-buttons.alter_button type="button" data-bs-toggle="modal"
                                    data-bs-target="#baseModal{{ $comentario->id }}" />

                                <!-- Modal Atualizar Comments -->
                                <x-modal.baseScroll :id="$comentario->id">
                                    <x-slot name="titulo">{{ __('Update Comment') }}</x-slot>
                                    <x-slot name="corpo">
                                        <form action="{{ route('comentario.atualizar', $comentario->id) }}"
                                            method="post">
                                            @method('PUT')
                                            @csrf
                                            <div>
                                                <x-text-input id="corpo" class="block mt-1 w-full form-control"
                                                    type="text" name="corpo" value="{{ $comentario->corpo }}"
                                                    required />
                                                <x-input-error :messages="$errors->get('corpo')" class="mt-2" />
                                            </div>
                                    </x-slot>
                                    <x-slot name="footer">
                                        <x-buttons.alter_button />
                                        </form>
                                    </x-slot>
                                </x-modal.baseScroll>
                            </div>

                            <div class="col-4">
                                <form action="{{ route('comentario.deletar', $comentario->id) }}" method="post">
                                    @method('DELETE')
                                    @csrf
                                    <x-danger-button>{{ __('Delete') }}</x-danger-button>
                                </form>
                            </div>
                        </div>
                    @endif
                </div>
            </li>
        @endforeach
    </ul>
</div>
