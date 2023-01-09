<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div x-data="{openCreate: false}" x-cloak class="grid grid-cols-4 grid-flow-col gap-10">
            <div class="col-span-1">
                <x-primary-button @click="openCreate = true" class="mb-3 w-full py-4">
                    Create Discussion
                </x-primary-button>

                @livewire('side.top-user')
            </div>

            <div class="col-span-3">
                <div @card-closed.window="openCreate = $event.detail.openCreate" x-show="openCreate" class="mb-5" x-transitio>
                    @livewire('threads.thread-create')
                </div>
                
                <div>
                    {{-- Filter --}}
                    <div class="flex justify-between">
                        <select wire:model="order" class="text-sm rounded-full w-40 px-4 py-3 bg-slate-900 border-green-500 placeholder-gray-400 text-gray-300 focus:border-green-500">
                            <option value="most-discussed">Most Discussed</option>
                            <option value="most-liked">Most Liked</option>
                            <option value="newest">Newest</option>
                        </select>

                        <input type="text" wire:model="search" placeholder="Search..." class="text-sm w-60 px-4 border-green-500 bg-slate-900 text-gray-300 focus:border-green-600 focus:ring-green-600 rounded-full">

                    </div>

                    {{-- List Thread --}}
                    <div>
                        @foreach($threads as $thread)
                            <div class="my-5 hover:cursor-pointer">
                                <a href="{{ route('thread.detail', ['thread' => $thread]) }}">
                                    <x-card class="flex justify-between gap-10 p-6">
                                        <div class="flex flex-col justify-between">
                                            <div>
                                                <div class="mb-3 font-bold text-xl">
                                                    <h3>{{ $thread->title }}</h3>
                                                </div>
                                
                                                <div class="font-normal text-sm text-gray-300">
                                                    <p>{{ strlen($thread->body) > 200 ? substr($thread->body, 0, 200).'...' : $thread->body }}</p>
                                                </div>
                                            </div>
    
                                            <div class="flex gap-4 mt-4 text-gray-500">
                                                <small>{{ isset($thread->created_at) ? $thread->created_at->format('d F Y') : '' }}</small>
                                                <small>|</small>
                                                <small>{{ $thread->likes_count }} Likes</small>
                                                <small>{{ $thread->replies_count + $thread->nested_replies_count }} Discussions</small>
                                            </div>
                                        </div>

                                        <div class="flex flex-col gap-4 items-center w-28 pr-3">
                                            <img 
                                                class="w-16 h-16 rounded-xl" 
                                                src="{{ isset($thread->author->avatar) ? asset('storage/avatars/'.$thread->author->avatar) : asset('assets/images/avatar-default.png') }}" 
                                                alt="User avatar">
                                            <div class="text-center w-full break-words">
                                                <p class="text-sm">{{ $thread->author->username }}</p>
                                                <small class="text-xs text-gray-500">{{ $thread->author->credit }} Credit</small>
                                            </div>
                                        </div>
                                    </x-card>
                                </a>
                            </div>
                        @endforeach
                    </div>
                
                    {{ $threads->links() }}
                </div>
            </div>
        </div>
    </div>
</div>