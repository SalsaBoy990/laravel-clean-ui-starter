<div x-data="{
    isModalOpen: $wire.entangle('isModalOpen')
}">

    @if ($hasSmallButton)
        <button @click="isModalOpen = true" class="danger margin-top-0" title="{{ __('Delete permission') }}">
            <i class="fa-solid fa-trash-can" aria-hidden="true"></i>
        </button>
    @else
        <button @click="isModalOpen = true" class="danger margin-top-0">
            <i class="fa-solid fa-trash-can" aria-hidden="true"></i>
            <span>{{ __('Delete') }}</span>
        </button>
    @endif

    <x-global::form-modal trigger="isModalOpen" title="{{ __('Are you sure you want to delete it?') }}"
                          id="{{ $modalId }}">
        <form wire:submit.prevent="deletePermission">
            <h2 class="h3">{{ $name }}</h2>
            <hr class="divider">

            <label for="permissionId" class="sr-only">{{ __('Permission Id') }}</label>
            <input wire:model.defer="permissionId"
                   disabled
                   type="number"
                   class="hidden"
                   name="permissionId"
                   id="permissionId"
                   value="{{ $permissionId }}"
            >

            <div class="actions">
                <button type="submit" class="danger">
                    <span wire:loading wire:target="deletePermission" class="animate-spin">&#9696;</span>
                    <span wire:loading.remove wire:target="deletePermission">{{ __('Delete') }}</span>
                </button>
                <button type="button" class="danger alt" @click="isModalOpen = false">
                    {{ __('Cancel') }}
                </button>
            </div>
        </form>

    </x-global::form-modal>
</div>
