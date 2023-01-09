<div x-data="{openCreate: false}">
    <div @card-reply-toggle.window="openCreate = $event.detail.open" x-show="openCreate" class="my-5">
        @livewire('threads.replies.reply-create', ['threadId' => $threadId])
    </div>

    @foreach($replies as $reply)
        <div class="my-5">
            <x-card>
                <div class="p-6">
                    <div class="mb-3">
                        <div class="font-normal text-sm text-gray-300">
                            <p>{{ $reply->body }}</p>
                        </div>
                    </div>

                    @livewire('threads.replies.reply-action', ['reply' => $reply])

                    <div class="pl-5 pt-3">
                        @livewire('threads.replies.nested.nested-list', ['replyId' => $reply->id])
                    </div>
                </div>
            </x-card>
        </div>
    @endforeach
</div>