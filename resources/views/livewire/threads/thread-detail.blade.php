<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="grid grid-cols-4 grid-flow-col gap-10">
            <div class="col-span-1">
                <x-card>
                    <div class="p-6">
                        {{ __("You're logged in!") }}
                    </div>
                </x-card>
            </div>

            <div class="col-span-3">
                <div x-data="{openEdit: false}">
                    <x-card class="border-2 border-green-700">
                        <div class="p-6">
                            <div class="flex justify-between mb-3">
                                <div class="text-sm text-gray-500">
                                    <small>Posted on 28 Januari 2023 15:57</small>
                                </div>
                                <x-dropdown align="right" width="48">
                                    <x-slot name="trigger">
                                        <x-icon-button>
                                            <i class="uil uil-ellipsis-v"></i>
                                        </x-icon-button>
                                    </x-slot>
                
                                    <x-slot name="content">
                                        <x-dropdown-link @click="openEdit = true">
                                            {{ __('Edit') }}
                                        </x-dropdown-link>
                
                                        <!-- Authentication -->
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                
                                            <x-dropdown-link :href="route('logout')"
                                                    onclick="event.preventDefault();
                                                                this.closest('form').submit();">
                                                {{ __('Delete') }}
                                            </x-dropdown-link>
                                        </form>
                                    </x-slot>
                                </x-dropdown>
                            </div>
                
                            <div x-show="!openEdit" class="mb-8">
                                <div class="mb-3 font-bold text-xl">
                                    <h3>{{ $thread->title }}</h3>
                                </div>
                    
                                <div class="font-normal text-sm text-gray-300">
                                    <p>{{ $thread->body }}</p>
                                </div>
                            </div>
                
                            <form x-show="openEdit" wire:submit.prevent="update" method="POST" class="mb-8">
                                <div class="mb-5">
                                    <x-input-label for="title" :value="__('Title')" />
                                    <x-text-input wire:model.lazy="title" id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title')" required autofocus />
                                    <x-input-error :messages="$errors->get('title')" class="mt-2" />
                                </div>
                
                                <div class="mb-5">
                                    <x-input-label for="body" :value="__('Description')" />
                                    <x-textarea-input rows="5" wire:model.lazy="body" id="body" class="block mt-1 w-full" type="text" name="body" :value="old('body')" required autofocus />
                                    <x-input-error :messages="$errors->get('body')" class="mt-2" />
                                </div>
                
                                <div class="flex justify-end gap-3">
                                    <x-danger-button type="button" @click="openEdit = false" class="text-xl p-0 bg-transparent border-2 border-red-600 text-red-600 hover:dark:bg-red-600 hover:dark:text-white">
                                        <i class="uil uil-times"></i>
                                    </x-danger-button>
                    
                                    <x-primary-button class="text-xl p-0">
                                        <i class="uil uil-message"></i>
                                    </x-primary-button>
                                </div>
                            </form>
                
                            <span @card-closed.window="openEdit = $event.detail.openEdit"></span>
                
                            @livewire('threads.thread-action', ['thread' => $thread])
                        </div>
                    </x-card>
                </div>         
                
                @livewire('threads.replies.reply-list', ['threadId' => $thread->id])
            </div>
        </div>
    </div>
</div>