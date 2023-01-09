<x-card>
    <div class="py-3 px-6">
        <small class="text-gray-500">Top Users</small>

        <div class="mt-3">
            @foreach ($users as $user)
                <div class="flex items-center gap-4 my-2">
                    <div>
                        <img 
                            class="w-10 h-10 rounded-full" 
                            src="{{ isset($user->avatar) ? asset('storage/avatars/'.$user->avatar) : asset('assets/images/avatar-default.png') }}" 
                            alt="User avatar">        
                    </div>
                    <div>
                        <p class="text-sm">{{ $user->username }}</p>
                        <small class="text-xs text-gray-500">{{ $user->credit }} Credit</small>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-card>