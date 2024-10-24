@props(['id'])


<div class="col mx-4 my-4">
    <div class="card shadow-sm">
        <x-livro.svg_imagem>
            <x-slot name="imagem">{{ $imagem }}</x-slot>
            <x-slot name="titulo">{{ $titulo }}</x-slot>
        </x-livro.svg_imagem>
        <div class="card-body text-center">
            <x-h1 class="card-title">{{ $titulo }}</x-h1>
            <p class="card-text">{{ __('Stock') }}: {{ $estoque }}</p>
            <small class="text-body-secondary">
                {{ $atualizacao }}
            </small>
            <div class="d-flex justify-content-center align-items-center">
                <div class="btn-group">
                    <form action="{{ route('livro.livro', ['titulo' => $titulo ?? null, 'id' => $id]) }}"
                        method="get">
                        <x-buttons.information_button />
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
