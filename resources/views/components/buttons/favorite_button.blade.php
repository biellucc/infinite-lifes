@props(['valor' => 'Favorite'])
<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center text-center px-4 py-2 bg-violet-400 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-violet-700 focus:bg-violet-700 active:bg-violet-900 focus:outline-none focus:ring-2 focus:ring-violet-500 focus:ring-offset-2 transition ease-in-out duration-150']) }}>
    {{ __($valor) }}
</button>
