<div>
    <x-card>
        <div class="p-6">
            <form wire:submit.prevent="store" method="POST">
                <div class="mb-5">
                    <x-textarea-input rows="5" placeholder="Write your reply" wire:model.lazy="body" id="body" class="block mt-1 w-full" type="text" name="body" :value="old('body')" required autofocus />
                    <x-input-error :messages="$errors->get('body')" class="mt-2" />
                </div>

                <div class="flex justify-end gap-3">
                    <x-danger-button type="button" @click="$dispatch('card-reply-toggle', {'open': false})" class="text-xl p-0 bg-transparent border-2 border-red-600 text-red-600 hover:dark:bg-red-600 hover:dark:text-white">
                        <i class="uil uil-times"></i>
                    </x-danger-button>
    
                    <x-primary-button class="text-xl p-0">
                        <i class="uil uil-message"></i>
                    </x-primary-button>
                </div>
            </form>
        </div>
    </x-card>
</div>
