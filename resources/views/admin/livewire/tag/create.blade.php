<div x-data="{
        isUploading: false,
        progress: 0,
        isModalOpen: $wire.entangle('isModalOpen')
    }"
     x-on:livewire-upload-start="isUploading = true"
     x-on:livewire-upload-finish="isUploading = false"
     x-on:livewire-upload-error="isUploading = false"
     x-on:livewire-upload-progress="progress = $event.detail.progress"
>

    @if ($hasSmallButton)
        <button @click="isModalOpen = true" class="primary" title="{{ __('New tag') }}">
            <i class="fa fa-plus"></i>
        </button>
    @else
        <button @click="isModalOpen = true" class="primary">
            <i class="fa fa-plus"></i>{{ __('New tag') }}
        </button>
    @endif

    <x-global::form-modal
        trigger="isModalOpen"
        title="{{ __('Add tag') }}"
        id="{{ $modalId }}"
    >
        <form wire:submit.prevent="createTag">

            <fieldset>
                <label for="name">{{ __('Tag name') }}<span class="text-red">*</span></label>
                <input
                    wire:model.defer="name"
                    type="text"
                    class="{{ $errors->has('name') ? 'border border-red' : '' }}"
                    name="name"
                    value=""
                >

                <div class="{{ $errors->has('name') ? 'error-message' : '' }}">
                    {{ $errors->has('name') ? $errors->first('name') : '' }}
                </div>


                <label for="slug">{{ __('Slug of the tag') }}<span class="text-red">*</span></label>
                <input
                    wire:model.defer="slug"
                    type="text"
                    class="{{ $errors->has('slug') ? 'border border-red' : '' }}"
                    name="slug"
                    value=""
                >

                <div class="{{ $errors->has('slug') ? 'error-message' : '' }}">
                    {{ $errors->has('slug') ? $errors->first('slug') : '' }}
                </div>


                <!-- Cover image -->
                <label for="cover_image_url">{{ __('Cover Image (optional)') }}</label>

                @if (isset($cover_image))
                    <div class="relative" style="width: fit-content">
                        Photo Preview:
                        <img src="{{ $cover_image->temporaryUrl() }}" alt="{{ __('Photo Preview:') }}"
                             class="card card-4 margin-bottom-1 image-preview"/>
                    </div>

                @else
                    <div class="relative" style="width: fit-content">
                        <img src="{{ $cover_image_url }}" alt="{{ __('Cover image') }}"
                             class="card card-4 margin-bottom-1 image-preview"/>
                    </div>
                @endif


                <input
                    id="cover-image-new-tag-{{ $iteration }}"
                    class="{{ $errors->has('cover_image') ? ' border border-red' : '' }}"
                    type="file"
                    wire:model="cover_image"
                    name="cover_image"
                />

                <div wire:loading wire:target="cover_image">Uploading...</div>

                <!-- Progress Bar -->
                <div x-show="isUploading">
                    <div class="gray-20 margin-bottom-top-0-5">
                        <div class="box green" x-bind:value="progress" style="width:1%; height: 22px"
                             :style="{ width: (progress + '%') }"
                             x-text="progress">0
                        </div>
                    </div>
                </div>


                <x-global::input-error for="cover_image"/>

            </fieldset>

            <div class="actions">
                <button type="submit" class="primary">
                    <span wire:loading wire:target="createTag" class="animate-spin">&#9696;</span>
                    <span wire:loading.remove wire:target="createTag">{{ __('Create') }}</span>
                </button>

                <button
                    type="button"
                    class="alt primary"
                    wire:click="initialize"
                >
                    {{ __('Cancel') }}
                </button>
            </div>

        </form>
    </x-global::form-modal>
</div>
