@props(['dimensoes', 'generos'])

<form method="POST" action="{{ route('livro.store') }}" enctype="multipart/form-data">
    @csrf

    <x-h1 class="card-title" :value="__('Register of Book')"></x-h1>

    <div class="my-3">
        <x-input-label for="titulo" :value="__('Title')" />
        <x-text-input id="titulo" class="block mt-1 w-full" type="text" name="titulo" :value="old('titulo')" autofocus
            placeholder="It a coisa" autocomplete="titulo" required />
        <x-input-error :messages="$errors->get('titulo')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="resumo" :value="__('About')" />
        <x-textarea id="resumo" class="block mt-1 w-full form-control" type="text" name="resumo" required />
        <x-input-error :messages="$errors->get('resumo')" class="mt-2" />
    </div>

    <div class="my-3">
        <x-input-label for="quantidade_paginas" :value="__('Amount of Pages')" />
        <x-text-input id="quantidade_paginas" class="block mt-1 w-full" type="number" name="quantidade_paginas"
            placeholder="1104" :value="old('quantidade_paginas')" autocomplete="quantidade_paginas" min="1" required />
        <x-input-error :messages="$errors->get('quantidade_paginas')" class="mt-2" />
    </div>

    <div class="my-3">
        <x-input-label for="valor" :value="__('Value')" />
        <x-text-input id="valor" class="block mt-1 w-full" type="number" name="valor" :value="old('valor')"
            placeholder="70,95" autocomplete="valor" min="1" step="any" required />
        <x-input-error :messages="$errors->get('valor')" class="mt-2" />
    </div>

    <div class="my-3">
        <x-input-label for="estoque" :value="__('Stock')" />
        <x-text-input id="estoque" class="block mt-1 w-full" type="number" name="estoque" placeholder="10"
            :value="old('estoque')" autocomplete="estoque" min="1" required />
        <x-input-error :messages="$errors->get('estoque')" class="mt-2" />
    </div>

    <div class="my-3">
        <x-input-label for="autor" :value="__('Author')" />
        <x-text-input id="autor" class="block mt-1 w-full" type="text" name="autor" :value="old('autor')"
            placeholder="Stephen King" autocomplete="autor" required />
        <x-input-error :messages="$errors->get('autor')" class="mt-2" />
    </div>

    <div class="my-3">
        <x-input-label for="isbn13" :value="__('ISBN13')" />
        <x-text-input id="isbn13" class="block mt-1 w-full" type="text" name="isbn13" :value="old('isbn13')"
            placeholder="978-66-876549-8-5" autocomplete="isbn13" required />
        <x-input-error :messages="$errors->get('isbn13')" class="mt-2" />
    </div>

    <div class="my-3">
        <x-input-label for="idioma" :value="__('Language')" />
        <x-text-input id="idioma" class="block mt-1 w-full" type="text" name="idioma" :value="old('idioma')"
            placeholder="Português" autocomplete="idioma" required />
        <x-input-error :messages="$errors->get('idioma')" class="mt-2" />
    </div>

    <div class="my-3">
        <x-input-label for="edicao" :value="__('Edition')" />
        <x-text-input id="edicao" class="block mt-1 w-full" type="number" name="edicao" :value="old('edicao')"
            placeholder="1" autocomplete="edicao" min="1" required />
        <x-input-error :messages="$errors->get('edicao')" class="mt-2" />
    </div>

    <div class="my-3">
        <x-input-label for="editora" :value="__('Publisher')" />
        <x-text-input id="editora" class="block mt-1 w-full" type="text" name="editora" :value="old('editora')"
            placeholder="Suma" autocomplete="editora" required />
        <x-input-error :messages="$errors->get('editora')" class="mt-2" />
    </div>

    <div class="my-3">
        <x-input-label for="dimensao_id" class="form-label" :value="__('Dimension')" />
        <x-select class="form-select" id="dimensao_id" name="dimensao_id">
            @foreach ($dimensoes as $dimensao)
                <option value="{{ $dimensao->id }}">{{ $dimensao->valor }}</option>
            @endforeach
        </x-select>
    </div>

    <div class="my-3">
        <x-input-label for="idade" :value="__('Recommended for')" />
        <x-text-input id="idade" class="block mt-1 w-full" type="number" name="idade" :value="old('idade')"
            placeholder="18" autocomplete="idade" min="5" max="18" required />
        <x-input-error :messages="$errors->get('idade')" class="mt-2" />
    </div>

    <div class="my-3">
        <x-input-label for="genero_id" class="form-label" :value="__('Type')" />
        <x-select class="form-select" id="genero_id" name="genero_id">
            @foreach ($generos as $genero)
                <option value="{{ $genero->id }}">{{ $genero->genero }}</option>
            @endforeach
        </x-select>
    </div>

    <div class="my-3">
        <x-input-label for="data_publicacao" :value="__('Date of publication')" />
        <x-text-input id="data_publicacao" class="block mt-1 w-full" type="date" name="data_publicacao"
            :value="old('data_publicacao')" autocomplete="data_publicacao" required />
        <x-input-error :messages="$errors->get('data_publicacao')" class="mt-2" />
    </div>

    <div class="my-3">
        <x-input-label for="imagem" :value="__('Image')" />
        <input type="file" class="form-control-file" id="imagem" name="imagem" required>
        <x-input-error :messages="$errors->get('imagem')" class="mt-2" />
    </div>

    <div class="d-flex justify-content-center container my-1">
        <div class="d-grid gap-2 col-5 mx-auto shadow">
            <x-primary-button>
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </div>
</form>

<form action="{{ route('estoque.index') }}" method="GET">
    <div class="d-flex justify-content-center container my-1">
        <div class="d-grid gap-2 col-5 mx-auto shadow">
            <x-buttons.close_button  valor="Back"/>
        </div>
    </div>
</form>
