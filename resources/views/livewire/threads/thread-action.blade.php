<div x-data class="flex justify-between items-center">
    <div class="flex gap-4">
        <x-icon-button wire:click="toggleLike" class="{{ $isLiked ? 'text-green-500' : '' }}">
            <i class="uil uil-thumbs-up"></i>
            <div class="text-base {{ $isLiked ? 'text-green-500' : 'text-gray-500' }}">
                <small>{{ $likesCount }}</small>
            </div>
        </x-icon-button>

        <x-icon-button wire:click="toggleDislike" class="{{ $isDisliked ? 'text-green-500' : '' }}">
            <i class="uil uil-thumbs-down"></i>
            <div class="text-base text-gray-500">
                <small>{{ $dislikesCount }}</small>
            </div>
        </x-icon-button>

        <x-icon-button @click="$dispatch('card-reply-toggle', {'open': true})">
            <i class="uil uil-comment"></i>
            <div class="text-base text-gray-500">
                <small>Reply</small>
            </div>
        </x-icon-button>
    </div>

    <div class="text-base text-gray-500 inline align-middle">
        <small>{{ $discussionsCount }} Discussions</small>
    </div>
</div>