<button {{ $attributes->merge(['class' => 'flex gap-2 items-center text-2xl text-gray-500 active:text-green-500 transition ease-in-out duration-300']) }}>
    {{ $slot }}
</button>
