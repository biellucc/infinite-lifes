<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Stock') }}
        </h2>
    </x-slot>

    <form action="{{ route('livro.formulario') }}" method="get">
        <x-primary-button class="ms-3">
            {{ __('Add') }}
        </x-primary-button>
    </form>

    <div class="container">
        @if ($livros->isNotEmpty())
            <div class="container">
                <div class="row">
                    @foreach ($livros as $livro)
                        <div class="col-md-3">
                            <x-vendedor.estoque.index :id="$livro->id">
                                <x-slot name="imagem">{{ $livro->imagem }}</x-slot>
                                <x-slot name="titulo">{{ $livro->titulo }}</x-slot>
                                <x-slot name="estoque">{{ $livro->estoque }}</x-slot>
                                <x-slot name="atualizacao">{{ $livro->updated_at }}</x-slot>
                            </x-vendedor.estoque.index>
                        </div>
                    @endforeach
                </div>
                <div class="d-flex justify-content-center">
                    {{ $livros->links() }}
                </div>
            </div>
        @else
            <x-h1 class="mt-5">{{ __('No stock found') }}</x-h1>
        @endif
    </div>
</x-app-layout>
