@props(['feedbacks'])
<div class="col-md-6 col-lg-12 order-md-last">
    <ul class="list-group mb-3">
        <h4 class="d-flex justify-content-between align-items-center mb-3">
            <span class="text-primary">{{ __('Your feedbacks') }}</span>
            <span class="badge bg-primary rounded-pill">{{ $feedbacks->count() }}</span>
        </h4>
        @foreach ($feedbacks as $feedback)
            <li class="list-group-item d-flex justify-content-between lh-sm mt-1">
                <div>
                    <h6 class="my-0">{{ $feedback->titulo }}</h6>
                    <small class="text-body-secondary">{{ __('Created on') }}:
                        {{ $feedback->created_at }}</small>
                    <small class="text-body-secondary">{{ __('Updated on') }}:
                        {{ $feedback->updated_at }}</small>

                    <div class="col-4">
                        <x-buttons.information_button type="button" data-bs-toggle="modal"
                            data-bs-target="#baseModal{{ $feedback->id }}" valor="Open" />
                    </div>
                </div>
                <span class="text-body-secondary">{{ __('Status') }}: {{ $feedback->status }}</span>
            </li>

            <!-- Modal Contendo Informações do Feedback -->
            <x-modal.baseScroll :id="$feedback->id">
                <x-slot name="titulo">{{ __('Feedback Open') }}</x-slot>
                <x-slot name="corpo">
                    <div class="mt-4">
                        <x-input-label for="titulo" value="{{ $feedback->titulo }}" />
                    </div>
                    <div class="mt-4">
                        <x-input-label for="corpo" value="{{ $feedback->corpo }}" />
                    </div>
                </x-slot>
                <x-slot name="footer">
                    <form action="{{ route('feedback.destroy', $feedback->id) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <x-danger-button>{{ __('Delete') }}</x-danger-button>
                    </form>
                </x-slot>
            </x-modal.baseScroll>
        @endforeach
    </ul>
</div>
