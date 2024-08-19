@props(['align' => 'right', 'width' => '48', 'contentClasses' => 'py-1 bg-white'])

@php
$alignmentClasses = match ($align) {
    'left' => 'dropdown-menu-start',
    'top' => 'dropdown-menu-top',
    default => 'dropdown-menu-end',
};

$width = match ($width) {
    '48' => 'w-48',
    default => $width,
};
@endphp

<div class="dropdown">
    <div {{ $attributes->merge(['class' => 'nav-link dropdown-toggle', 'data-bs-toggle' => 'dropdown', 'aria-expanded' => 'false']) }}>
        {{ $trigger }}
    </div>
    <ul class="dropdown-menu {{ $alignmentClasses }} {{ $contentClasses }}">
        {{ $content }}
    </ul>
</div>
