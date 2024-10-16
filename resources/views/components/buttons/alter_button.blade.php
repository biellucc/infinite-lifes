@props(['valor' => 'Alter'])
<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center text-center px-4 py-2 bg-amber-400 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-amber-700 focus:bg-amber-700 active:bg-amber-900 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:ring-offset-2 transition ease-in-out duration-150']) }}>
    {{ __($valor) }}
</button>
