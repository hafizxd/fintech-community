<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-primary-button type="button" onclick="document.querySelector('#linkCreate').click()" class="mb-4 w-full rounded-full py-4">
                Create Class
            </x-primary-button>
            <a href="{{ route('class.create') }}" id="linkCreate" class="hidden"></a>
    </div>
</div>