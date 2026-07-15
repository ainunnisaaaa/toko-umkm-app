<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-tokopedia border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-tokopedia-dark focus:bg-tokopedia-dark active:bg-tokopedia-dark focus:outline-none focus:ring-2 focus:ring-tokopedia focus:ring-offset-2 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
