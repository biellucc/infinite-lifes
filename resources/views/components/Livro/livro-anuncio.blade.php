@props(['id'])

<div class="col mt-2">
    <div class="card shadow-sm">
        <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg"
            role="img" aria-label="Espaço reservado: Miniatura" preserveAspectRatio="xMidYMid slice" focusable="false">
            <rect width="100%" height="100%" fill="#55595c"/>
            <image x="10" y="10" width="280" height="180" alt="{{ $titulo }}" href="/imagem/livros/{{ $imagem }}" />
        </svg>
        <div class="card-body">
            <x-h1 class="card-title">{{ $titulo }}</x-h1>
            <p class="card-text">{{ $resumo }}</p>
            <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                    <form action="{{ route('site.livro', ['titulo' => $titulo ?? null ,'id' => $id ]) }}" method="get">
                        <x-buttons.information_button />
                    </form>
                </div>
                <small class="text-body-secondary ml-2">
                    {{ $tempo }}
                </small>
            </div>
        </div>
    </div>
</div>
