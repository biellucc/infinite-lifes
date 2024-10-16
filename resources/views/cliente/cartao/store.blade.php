<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Register Card') }}
        </h2>
    </x-slot>

    <form method="POST" action="{{ route('cartao.store') }}">
        @csrf

        <div class="d-flex justify-content-center container">
            <x-cliente.cartao.base class="col-md-4">
                <x-slot name="tipo">
                    <x-select class="form-select" id="tipo" name="tipo">
                        <option value="credito">Crédito</option>
                        <option value="debito">Debito</option>
                    </x-select>
                    <x-input-error :messages="$errors->get('tipo')" class="mt-2" />
                </x-slot>

                <x-slot name="numero">
                    <x-text-input id="numero" class="block mt-1 w-full mt-2" type="text" name="numero"
                        :value="old('numero')" placeholder="1234 5678 1234 4321" required autocomplete="numero" />
                    <x-input-error :messages="$errors->get('numero')" class="mt-2" />
                </x-slot>

                <x-slot name="validade">
                    <x-text-input id="validade" class="block mt-1 w-full mt-2" type="date" name="validade"
                        :value="old('validade')" required autocomplete="validade" />
                    <x-input-error :messages="$errors->get('validade')" class="mt-2" />
                </x-slot>
            </x-cliente.cartao.base>
        </div>

        <div class="d-flex justify-content-center container mt-1">
            <div class="d-grid gap-2 col-5 mx-auto shadow">
                <x-buttons.add_button/>
            </div>
        </div>
    </form>
</x-app-layout>
