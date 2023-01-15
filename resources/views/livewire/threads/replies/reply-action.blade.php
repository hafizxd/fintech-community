<div x-data class="flex justify-between">
    <div class="flex gap-4">
        <x-icon-button wire:click="toggleLike" class="{{ $isLiked ? 'text-green-500' : '' }}">
            <i class="uil uil-thumbs-up text-base sm:text-lg"></i>
            <div class="text-xs sm:text-sm text-gray-500">{{ $likesCount }}</div>
        </x-icon-button>

        <x-icon-button wire:click="toggleDislike" class="{{ $isDisliked ? 'text-green-500' : '' }}">
            <i class="uil uil-thumbs-down text-base sm:text-lg"></i>
            <div class="text-xs sm:text-sm text-gray-500">{{ $dislikesCount }}</div>
        </x-icon-button>

        <x-icon-button @click="$dispatch('card-nested-toggle', {'open': true, 'replyId': {{ $reply->id }}})">
            <i class="uil uil-comment text-base sm:text-lg"></i>
            <div class="text-xs sm:text-sm text-gray-500">Reply</div>
        </x-icon-button>
    </div>
</div>