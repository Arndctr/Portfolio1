<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex justify-center items-center px-4 py-3 bg-transparent border-2 border-blue-500 rounded-md font-semibold text-xs text-blue-500 uppercase tracking-widest hover:bg-blue-100 focus:bg-blue-100 active:bg-blue-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
