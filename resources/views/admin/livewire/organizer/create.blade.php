<article x-data="{ isModalOpen: $wire.$entangle('isModalOpen', true) }">

    @if ($hasSmallButton)
        <button @click="isModalOpen = true" class="primary" title="{{ __('New organizer') }}">
            <i class="fa fa-plus"></i>
        </button>
    @else
        <button @click="isModalOpen = true" class="primary">
            <i class="fa fa-plus"></i>{{ __('New organizer') }}
        </button>
    @endif

    <x-global::form-modal
        trigger="isModalOpen"
        title="{{ __('New organizer') }}"
        id="{{ $modalId }}"
    >
        <form wire:submit="createOrganizer">
            <fieldset>

                <!-- Name -->
                <label for="name">{{ __('Organizer name') }}<span class="text-red">*</span></label>
                <input wire:model="name"
                       type="text"
                       class="{{ $errors->has('name') ? 'border border-red' : '' }}"
                       name="name"
                       autofocus
                >

                <p class="{{ $errors->has('name') ? 'error-message' : '' }}">
                    {{ $errors->has('name') ? $errors->first('name') : '' }}
                </p>


                <!-- Slug -->
                <label for="slug">{{ __('Slug') }}<span class="text-red">*</span></label>
                <input wire:model="slug"
                       type="text"
                       class="{{ $errors->has('slug') ? 'border border-red' : '' }}"
                       name="slug"
                >

                <p class="{{ $errors->has('slug') ? 'error-message' : '' }}">
                    {{ $errors->has('slug') ? $errors->first('slug') : '' }}
                </p>

                <!-- Facebook url -->
                <label for="facebook_url">{{ __('Facebook URL') }}<span class="text-red">*</span></label>
                <input wire:model="facebook_url"
                       type="url"
                       class="{{ $errors->has('facebook_url') ? 'border border-red' : '' }}"
                       name="facebook_url"
                >

                <p class="{{ $errors->has('facebook_url') ? 'error-message' : '' }}">
                    {{ $errors->has('facebook_url') ? $errors->first('facebook_url') : '' }}
                </p>

            </fieldset>

            <div class="actions">
                <button type="submit" class="primary">
                    <span wire:loading wire:target="createOrganizer" class="animate-spin">&#9696;</span>
                    <span wire:loading.remove wire:target="createOrganizer">{{ __('Update') }}</span>
                </button>
                <button type="button" class="primary alt" @click="isModalOpen = false">
                    {{ __('Cancel') }}
                </button>
            </div>
        </form>

    </x-global::form-modal>
</article>
