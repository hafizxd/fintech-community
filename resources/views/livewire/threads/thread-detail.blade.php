<div class="py-12">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-4 md:grid-flow-col md:gap-10">
            <div class="hidden md:block col-span-1">
                <x-card>
                    <div class="flex flex-col items-center py-3 px-6">
                        <small class="text-gray-500">Author</small>

                        <div class="my-4">
                            <img 
                                class="w-24 h-24 rounded-full" 
                                src="{{ isset($thread->author->avatar) ? asset('storage/avatars/'.$thread->author->avatar) : asset('assets/images/avatar-default.png') }}" 
                                alt="User avatar">        
                        </div>

                        <div class="w-full flex flex-col items-center">
                            <p class="text-sm">{{ $thread->author->username }}</p>
                            <div>
                                <small class="text-xs text-gray-500">{{ $thread->author->credit }} Credit</small>
                            </div>
                        </div>
                    </div>
                </x-card>
            </div>

            <div class="col-span-3">
                <div x-data="{openEdit: false}">
                    <x-card class="border-2 border-green-700">
                        <div class="p-6">
                            <div class="flex justify-between mb-3">
                                <div class="text-sm text-gray-500">
                                    <small>Posted on {{ $thread->created_at->format('d F Y H:i') }}</small>
                                </div>
                                @if ($thread->author->id == auth()->user()->id)
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
                                            <x-dropdown-link wire:click="destroy">
                                                {{ __('Delete') }}
                                            </x-dropdown-link>
                                        </x-slot>
                                    </x-dropdown>
                                @endif
                            </div>
                
                            <div x-show="!openEdit" class="mb-8">
                                <div class="sm:mb-3 font-medium text-base sm:text-lg">
                                    <h3>{{ $thread->title }}</h3>
                                </div>
                    
                                <div class="font-normal text-xs sm:text-sm text-gray-400">
                                    <p>{!! nl2br(e($thread->body)) !!}</p>
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

            <div class="sm:hidden col-span-1">
                <x-card>
                    <div class="flex flex-col items-center py-3 px-6">
                        <small class="text-gray-500">Author</small>

                        <div class="my-4">
                            <img 
                                class="w-24 h-24 rounded-full" 
                                src="{{ isset($thread->author->avatar) ? asset('storage/avatars/'.$thread->author->avatar) : asset('assets/images/avatar-default.png') }}" 
                                alt="User avatar">        
                        </div>

                        <div class="w-full flex flex-col items-center">
                            <p class="text-sm">{{ $thread->author->username }}</p>
                            <div>
                                <small class="text-xs text-gray-500">{{ $thread->author->credit }} Credit</small>
                            </div>
                        </div>
                    </div>
                </x-card>
            </div>
        </div>
    </div>
</div>