<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Tambah Tarif Pengiriman') }}
            </h2>
            <a href="{{ route('admin.shipping-rates.index') }}" class="text-indigo-600 hover:text-indigo-900 transition">
                &larr; Kembali
            </a>
        </div>
    </x-slot>

    <div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-sm">
        <form action="{{ route('admin.shipping-rates.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="province" class="block text-sm font-medium text-gray-700">Provinsi</label>
                <input type="text" name="province" id="province" value="{{ old('province') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                @error('province')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="city" class="block text-sm font-medium text-gray-700">Kota/Kabupaten</label>
                <input type="text" name="city" id="city" value="{{ old('city') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                @error('city')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="cost" class="block text-sm font-medium text-gray-700">Tarif (Rp)</label>
                <input type="number" step="0.01" name="cost" id="cost" value="{{ old('cost') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                @error('cost')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end">
                <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md text-sm font-medium hover:bg-indigo-700 transition">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
