<div x-data="{openCreate: false}">
    @foreach($nested as $nest)
        <div class="my-1">
            <div class="flex gap-4">
                <img 
                    class="w-12 h-12 rounded-lg" 
                    src="{{ isset($nest->author->avatar) ? asset('storage/avatars/'.$nest->author->avatar) : asset('assets/images/avatar-default.png') }}" 
                    alt="User avatar">

                <div class="w-full">
                    <div class="flex justify-between items-center mb-2">
                        <p class="text-xs sm:text-sm font-semibold text-white">{{ $nest->author->username }}</p>
                        <small class="text-xs text-gray-500">{{ $nest->created_at->format('d F Y H:i') }}</small>
                    </div>

                    <div class="mb-3">
                        <div class="font-normal text-sm text-gray-300 mb-2">
                            <p>{{ $nest->body }}</p>
                        </div>

                        @livewire('threads.replies.nested.nested-action', ['nested' => $nest], key($nest->id))
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <div 
        @card-nested-toggle.window="$event.detail.replyId == {{ $replyId }} ? openCreate = $event.detail.open : ''" x-show="openCreate">
        @livewire('threads.replies.nested.nested-create', ['replyId' => $replyId])
    </div>
</div>