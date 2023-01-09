<div x-data="{openCreate: false}">
    @foreach($nested as $nest)
        <div class="my-1">
            <x-card>
                <div class="px-6 py-3">
                    <div class="mb-3">
                        <div class="font-normal text-sm text-gray-300">
                            <p>{{ $nest->body }}</p>
                        </div>
                    </div>

                    @livewire('threads.replies.nested.nested-action', ['nested' => $nest], key($nest->id))
                </div>
            </x-card>
        </div>
    @endforeach

    <div 
        @card-nested-toggle.window="$event.detail.replyId == {{ $replyId }} ? openCreate = $event.detail.open : ''" x-show="openCreate">
        @livewire('threads.replies.nested.nested-create', ['replyId' => $replyId])
    </div>
</div>