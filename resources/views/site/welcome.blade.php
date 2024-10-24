<x-app-layout>
    <div class="container">
        <div
            class="relative min-h-screen flex flex-col items-center justify-center selection:bg-[#FF2D20] selection:text-white">
            <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">


                <main class="mt-6">
                    @if ($livros->isNotEmpty())
                        <div class="container">
                            <div class="row">
                                @foreach ($livros as $livro)
                                    <div class="col md-4">
                                        <x-livro.livro-anuncio :id="$livro->id">
                                            <x-slot name="imagem">{{ $livro->imagem }}</x-slot>
                                            <x-slot name="titulo">{{ $livro->titulo }}</x-slot>
                                            <x-slot name="resumo">{{ $livro->resumo }}</x-slot>
                                            <x-slot name="tempo">{{ $livro->created_at }}</x-slot>
                                        </x-livro.livro-anuncio>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <!-- Links de paginação -->
                        <div class="d-flex justify-content-center">
                            {{ $livros->links() }}
                        </div>
                    @else
                    @endif
                </main>
            </div>
        </div>
    </div>
</x-app-layout>
