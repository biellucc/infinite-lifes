@props(['dimensoes', 'generos', 'livro'])
<form method="POST" action="{{ route('livro.atualizar', $livro->id) }}" enctype="multipart/form-data">
    @method('PUT')
    @csrf

    <x-h1 class="card-title" :value="__('Update of Book')"></x-h1>

    <div class="my-3">
        <x-input-label for="titulo" :value="__('Title')" />
        <x-text-input id="titulo" class="block mt-1 w-full" type="text" name="titulo" :value="$livro->titulo" autofocus
            autocomplete="titulo" required />
        <x-input-error :messages="$errors->get('titulo')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="resumo" :value="__('Summary')" />
        <x-textarea id="resumo" class="block mt-1 w-full form-control" type="text" name="resumo" required>
            {{ $livro->resumo }} </x-textarea>
        <x-input-error :messages="$errors->get('resumo')" class="mt-2" />
    </div>

    <div class="my-3">
        <x-input-label for="quantidade_paginas" :value="__('Quantity of Pages')" />
        <x-text-input id="quantidade_paginas" class="block mt-1 w-full" type="number" name="quantidade_paginas"
            :value="$livro->quantidade_paginas" autocomplete="quantidade_paginas" min="1" required />
        <x-input-error :messages="$errors->get('quantidade_paginas')" class="mt-2" />
    </div>

    <div class="my-3">
        <x-input-label for="valor" :value="__('Value')" />
        <x-text-input id="valor" class="block mt-1 w-full" type="number" name="valor" :value="$livro->valor"
            autocomplete="valor" min="1" step="any" required />
        <x-input-error :messages="$errors->get('valor')" class="mt-2" />
    </div>

    <div class="my-3">
        <x-input-label for="estoque" :value="__('Stock')" />
        <x-text-input id="estoque" class="block mt-1 w-full" type="number" name="estoque" :value="$livro->estoque"
            autocomplete="estoque" min="1" required />
        <x-input-error :messages="$errors->get('estoque')" class="mt-2" />
    </div>

    <div class="my-3">
        <x-input-label for="autor" :value="__('Author')" />
        <x-text-input id="autor" class="block mt-1 w-full" type="text" name="autor" :value="$livro->autor"
            autocomplete="autor" required />
        <x-input-error :messages="$errors->get('autor')" class="mt-2" />
    </div>

    <div class="my-3">
        <x-input-label for="isbn13" :value="__('ISBN13')" />
        <x-text-input id="isbn13" class="block mt-1 w-full" type="text" name="isbn13" :value="$livro->isbn13"
            autocomplete="isbn13" required />
        <x-input-error :messages="$errors->get('isbn13')" class="mt-2" />
    </div>

    <div class="my-3">
        <x-input-label for="idioma" :value="__('Language')" />
        <x-text-input id="idioma" class="block mt-1 w-full" type="text" name="idioma" :value="$livro->idioma"
            autocomplete="idioma" required />
        <x-input-error :messages="$errors->get('idioma')" class="mt-2" />
    </div>

    <div class="my-3">
        <x-input-label for="edicao" :value="__('Edition')" />
        <x-text-input id="edicao" class="block mt-1 w-full" type="number" name="edicao" :value="$livro->edicao"
            autocomplete="edicao" min="1" required />
        <x-input-error :messages="$errors->get('edicao')" class="mt-2" />
    </div>

    <div class="my-3">
        <x-input-label for="editora" :value="__('Publisher')" />
        <x-text-input id="editora" class="block mt-1 w-full" type="text" name="editora" :value="$livro->editora"
            autocomplete="editora" required />
        <x-input-error :messages="$errors->get('editora')" class="mt-2" />
    </div>

    <div class="my-3">
        <x-input-label for="dimensao_id" class="form-label" :value="__('Dimension')" />
        <x-select class="form-select" id="dimensao_id" name="dimensao_id">
            <option value="{{ $livro->dimensao_id }}" selected>{{ $livro->dimensao->valor }}</option>
            @foreach ($dimensoes as $dimensao)
                <option value="{{ $dimensao->id }}">{{ $dimensao->valor }}</option>
            @endforeach
        </x-select>
    </div>

    <div class="my-3">
        <x-input-label for="idade" :value="__('Age')" />
        <x-text-input id="idade" class="block mt-1 w-full" type="number" name="idade" :value="$livro->idade"
            autocomplete="idade" min="5" max="18" required />
        <x-input-error :messages="$errors->get('idade')" class="mt-2" />
    </div>

    <div class="my-3">
        <x-input-label for="genero_id" class="form-label" :value="__('Type')" />
        <x-select class="form-select" id="genero_id" name="genero_id">
            <option value="{{ $livro->genero_id }}" selected>{{ $livro->genero->genero }}</option>
            @foreach ($generos as $genero)
                <option value="{{ $genero->id }}">{{ $genero->genero }}</option>
            @endforeach
        </x-select>
    </div>

    <div class="my-3">
        <x-input-label for="data_publicacao" :value="__('Publication Date')" />
        <x-text-input id="data_publicacao" class="block mt-1 w-full" type="date" name="data_publicacao"
            :value="$livro->data_publicacao" autocomplete="data_publicacao" required />
        <x-input-error :messages="$errors->get('data_publicacao')" class="mt-2" />
    </div>

    <div class="my-3">
        <x-input-label for="imagem" class="form-label" :value="__('Image')" />
        <input type="file" class="form-control" id="imagem" name="imagem" required>
        <x-input-error :messages="$errors->get('imagem')" class="mt-2" />
    </div>

    <div class="flex items-center justify-end my-3">
        <x-primary-button class="ms-4">
            {{ __('Register') }}
        </x-primary-button>
    </div>

</form>
