<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-md text-gray-500 leading-tight">
            {{ __('> Peminjaman') }}
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="mx-auto sm:px-4 lg:px-6">
            @livewire('admin.peminjaman.index')
        </div>
    </div>
</x-app-layout>
