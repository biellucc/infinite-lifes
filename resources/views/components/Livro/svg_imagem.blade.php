@props(['x' => 1, 'y' => 1, 'width' => '100%', 'height' => '100%' ])

<svg class="bd-placeholder-img card-img-top" width="{{ $width }}" height="{{ $height }}" xmlns="http://www.w3.org/2000/svg" role="img"
    aria-label="Espaço reservado: Miniatura" preserveAspectRatio="xMidYMid slice" focusable="false">
    <image x="{{ $x }}" y="{{ $y }}" width="{{ $width }}" height="{{ $height }}" alt="{{ $titulo }}"
        href="/assets/livro/imagem/{{ $imagem }}" />
</svg>
