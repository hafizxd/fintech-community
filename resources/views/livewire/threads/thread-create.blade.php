<div>
    <x-card>
        <div class="p-6">
            <form wire:submit.prevent="store" method="POST">
                <div class="mb-5">
                    <x-input-label for="title" :value="__('Title')" />
                    <x-text-input wire:model.lazy="title" id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title')" required autofocus />
                    <x-input-error :messages="$errors->get('title')" class="mt-2" />
                </div>

                <div class="mb-5">
                    <x-input-label for="body" :value="__('Description')" />
                    <x-textarea-input wire:model.lazy="body" id="body" class="block mt-1 w-full" type="text" name="body" :value="old('body')" required autofocus />
                    <x-input-error :messages="$errors->get('body')" class="mt-2" />
                </div>

                <div class="flex justify-end gap-3">
                    <x-danger-button type="button" wire:click="$emit('close-card')" class="text-2xl p-0 bg-transparent border-2 border-red-600 text-red-600 hover:dark:bg-red-600 hover:dark:text-white">
                        <i class="uil uil-times"></i>
                    </x-danger-button>
    
                    <x-primary-button class="text-2xl p-0">
                        <i class="uil uil-message"></i>
                    </x-primary-button>
                </div>
            </form>
        </div>
    </x-card>
</div>
