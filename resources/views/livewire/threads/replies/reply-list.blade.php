<div x-data="{openCreate: false}">
    <div @card-reply-toggle.window="openCreate = $event.detail.open" x-show="openCreate" class="my-5">
        @livewire('threads.replies.reply-create', ['threadId' => $threadId])
    </div>

    @foreach($replies as $key => $reply)
        <div class="my-5">
            <x-card>
                <div class="p-6 pb-2 flex gap-4">
                    <img 
                            class="w-14 h-14 rounded-lg" 
                            src="{{ isset($reply->author->avatar) ? asset('storage/avatars/'.$reply->author->avatar) : asset('assets/images/avatar-default.png') }}" 
                            alt="User avatar">

                    <div class="w-full">
                        <div class="flex justify-between mb-2">
                            <p class="text-xs sm:text-sm font-semibold text-white">{{ $reply->author->username }}</p>
                            <small class="text-xs text-gray-500">{{ $reply->created_at->format('d F Y H:i') }}</small>
                        </div>

                        <div>
                            <div class="mb-3">
                                <div class="font-normal text-xs sm:text-sm text-gray-300">
                                    <p>{{ $reply->body }}</p>
                                </div>
                            </div>
        
                            @livewire('threads.replies.reply-action', ['reply' => $reply], key('reply-action-'.$key))
                        </div>

                        <div class="pt-3">
                            @livewire('threads.replies.nested.nested-list', ['replyId' => $reply->id], key('nested-list-'.$key))
                        </div>
                    </div>
                </div>
            </x-card>
        </div>
    @endforeach
</div>