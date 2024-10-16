<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Book') }}
        </h2>
    </x-slot>

    <div class="container">
        <x-livro.livro_informacoes :livro="$livro">
            <x-slot name="botoes">
                <div class="col-4">
                    <form action="{{ route('livro.formulario_atualizar', $livro->id) }}" method="GET">
                        @csrf
                        <x-buttons.alter_button />
                    </form>
                </div>
                <div class="col-4">
                    <a href="{{ route('estoque.index') }}" class="btn btn-dark">{{ __('Back') }}</a>
                </div>
                <div class="col-4">
                    <form action="{{ route('livro.deletar', $livro->id) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <x-danger-button>{{ __('Delete') }}</x-danger-button>
                    </form>
                </div>
            </x-slot>
        </x-livro.livro_informacoes>
    </div>
</x-app-layout>
