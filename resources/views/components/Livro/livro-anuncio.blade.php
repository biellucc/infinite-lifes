@props(['id'])
<div class="col mx-4 my-2">
    <div class="card shadow-sm h-100 d-flex flex-column" style="min-height: 400px; max-height: 400px">
        <x-livro.svg_imagem>
            <x-slot name="imagem">{{ $imagem }}</x-slot>
            <x-slot name="titulo">{{ $titulo }}</x-slot>
        </x-livro.svg_imagem>
        <div class="card-body d-flex flex-column">
            <!-- Título do Livro -->
            <x-h1 class="card-title mb-2">
                {{ $titulo }}
            </x-h1>

            <!-- Resumo com limite -->
            <p class="card-text flex-grow-1">
                {{ Str::limit($resumo, 40, '...') }}
            </p>

            <!-- Informações adicionais -->
            <p class="card-text mt-auto"><small class="text-body-secondary">
                {{ $tempo }}
            </small></p>

            <!-- Botão -->
            <div class="d-flex justify-content-between align-items-center mt-3">
                <div class="btn-group">
                    <form action="{{ route('site.livro', ['titulo' => $titulo ?? null, 'id' => $id]) }}" method="get">
                        <x-buttons.information_button />
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
