@props(['valor' => 'Informations'])
<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center text-center px-4 py-2 bg-purple-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-purple-700 focus:bg-purple-700 active:bg-purple-900 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 transition ease-in-out duration-150']) }}>
    {{ __($valor) }}
</button>
