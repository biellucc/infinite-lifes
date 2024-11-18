@props(['valor' => 'Close'])
<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center text-center px-4 py-2 bg-lime-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-lime-700 focus:bg-lime-700 active:bg-lime-900 focus:outline-none focus:ring-2 focus:ring-lime-600 focus:ring-offset-2 transition ease-in-out duration-150']) }}>
    {{ __($valor) }}
</button>
