<nav class="bg-blue-600 p-4">
    <div class="container mx-auto flex items-center justify-between">
        <!-- Logo e título -->
        <a href="{{ route('site') }}" class="text-white text-xl font-semibold">
            {{ config('app.name', 'Infinite Life') }}
        </a>

        <!-- Botão para menu colapsável (responsivo) -->
        <button @click="isOpen = !isOpen" class="text-white lg:hidden">
            <span class="navbar-toggler-icon">☰</span>
        </button>

        <!-- Conteúdo da navbar -->
        <div :class="{'block': isOpen, 'hidden': !isOpen}" class="lg:flex lg:items-center lg:space-x-6">
            <ul class="flex space-x-4">
                <!-- Link para Home -->
                <li>
                    <a href="{{ route('site') }}" class="text-white hover:text-gray-300">{{ __('Home') }}</a>
                </li>

                <!-- Link para Books -->
                <li>
                    <a href="{{ route('site') }}" class="text-white hover:text-gray-300">{{ __('Books') }}</a>
                </li>

                <!-- Dropdown de Perfil -->
                <li class="relative" x-data="{ open: false }" @click.away="open = false">
                    <button @click="open = !open" class="text-white hover:text-gray-300">
                        {{ __('Perfil') }}
                    </button>
                    <div x-show="open" x-transition
                         class="absolute right-0 bg-white shadow-lg rounded-md w-48 mt-2 z-50">
                        <ul class="py-2">
                            @if (!Auth::check())
                                <li><a href="{{ route('login') }}" class="block px-4 py-2 text-gray-700">{{ __('Log in') }}</a></li>
                                <li><a href="{{ route('register') }}" class="block px-4 py-2 text-gray-700">{{ __('Register') }}</a></li>
                            @else
                                <li><a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-gray-700">{{ __('Profile') }}</a></li>
                                @if (Auth::user()->vendedor)
                                    <li><a href="#" class="block px-4 py-2 text-gray-700">{{ __('Stock') }}</a></li>
                                    <li><a href="#" class="block px-4 py-2 text-gray-700">{{ __('Sales') }}</a></li>
                                @elseif (Auth::user()->cliente)
                                    <li><a href="{{ route('carrinho.index') }}" class="block px-4 py-2 text-gray-700">{{ __('Carts') }}</a></li>
                                    <li><a href="{{ route('favorito.index') }}" class="block px-4 py-2 text-gray-700">{{ __('Favorites') }}</a></li>
                                    <li><a href="{{ route('visitado.index') }}" class="block px-4 py-2 text-gray-700">{{ __('Visiteds') }}</a></li>
                                    <li><a href="{{ route('cartao.index') }}" class="block px-4 py-2 text-gray-700">{{ __('Card') }}</a></li>
                                    <li><a href="{{ route('pedido.index') }}" class="block px-4 py-2 text-gray-700">{{ __('Orders') }}</a></li>
                                @else
                                    <li><a href="#" class="block px-4 py-2 text-gray-700">{{ __("Users") }}</a></li>
                                @endif
                                <li><a href="#" class="block px-4 py-2 text-gray-700">{{ __("Feedback") }}</a></li>
                                <li><hr class="border-gray-200 my-2" />
                                <li><a href="{{ route('sair') }}" class="block px-4 py-2 text-gray-700">{{ __('Log Out') }}</a></li>
                            @endif
                        </ul>
                    </div>
                </li>
            </ul>

            <!-- Formulário de pesquisa -->
            <form class="flex items-center space-x-2">
                <input type="search" placeholder="{{ __('Search') }}" class="px-4 py-2 rounded border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-600" />
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">
                    {{ __("Search") }}
                </button>
            </form>
        </div>
    </div>
</nav>

<!-- Scripts do Alpine.js (para comportamento do dropdown e menu) -->
<script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.js" defer></script>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('navbar', () => ({
            isOpen: false,
            isDropdownOpen: false
        }));
    });
</script>
