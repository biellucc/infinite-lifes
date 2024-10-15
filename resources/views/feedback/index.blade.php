<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Feedbacks') }}
        </h2>
    </x-slot>

    @if (!Auth::user()->administrador)
        <div class="row">
            <div class="col-3">
                <x-primary-button class="ms-3" type="button" data-bs-toggle="modal" data-bs-target="#storeModal">
                    {{ __('Add') }}
                </x-primary-button>
            </div>
        </div>
    @endif

    <div class="container mt-3">
        @if ($feedbacks->isNotEmpty())
            <x-usuarios.feedback.index :feedbacks="$feedbacks"></x-usuarios.feedback.index>
            <div class="d-flex justify-content-center">
                {{ $feedbacks->links() }}
            </div>
        @else
            <x-h1 class="mt-5">{{ __('No feedbacks found') }}</x-h1>
        @endif
    </div>

    <form action="{{ route('feedback.store') }}" method="post">
        @csrf
        <x-modal.storeScroll>
            <x-slot name="titulo">{{ __('Store Feedback') }}</x-slot>
            <x-slot name="corpo">
                <div class="mt-4">
                    <x-input-label for="titulo" :value="__('Title')" />
                    <x-text-input id="titulo" class="block mt-1 w-full" type="text" name="titulo"
                        autocomplete="titulo" required />
                    <x-input-error :messages="$errors->get('titulo')" class="mt-2" />
                </div>
                <div class="mt-4">
                    <x-input-label for="corpo" :value="__('Texto')" />
                    <x-textarea id="corpo" class="block mt-1 w-full form-control" type="text" name="corpo"
                        required />
                    <x-input-error :messages="$errors->get('corpo')" class="mt-2" />
                </div>
            </x-slot>
            <x-slot name="footer">
                <x-primary-button>{{ __('Add') }}</x-primary-button>
            </x-slot>
        </x-modal.storeScroll>
    </form>
</x-app-layout>
