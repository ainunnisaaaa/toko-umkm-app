<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Detail Kategori') }}
            </h2>
            <div class="flex space-x-3">
                <a href="{{ route('admin.categories.edit', $category->id) }}" class="px-4 py-2 bg-amber-500 text-white rounded-md text-sm font-medium hover:bg-amber-600 transition">
                    Edit Kategori
                </a>
                <a href="{{ route('admin.categories.index') }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md text-sm font-medium hover:bg-gray-300 transition">
                    Kembali
                </a>
            </div>
        </div>
    </x-slot>

    <div class="max-w-3xl mx-auto bg-white overflow-hidden shadow rounded-lg border border-gray-200">
        <div class="px-4 py-5 sm:px-6 flex items-center space-x-4">
            <div class="text-4xl">{{ $category->icon ?? '📁' }}</div>
            <div>
                <h3 class="text-lg leading-6 font-medium text-gray-900">
                    Informasi Kategori
                </h3>
                <p class="mt-1 max-w-2xl text-sm text-gray-500">
                    Detail data kategori produk.
                </p>
            </div>
        </div>
        <div class="border-t border-gray-200 px-4 py-5 sm:p-0">
            <dl class="sm:divide-y sm:divide-gray-200">
                <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        Nama Kategori
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        {{ $category->name }}
                    </dd>
                </div>
                <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        Ikon
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        {{ $category->icon ?: '-' }}
                    </dd>
                </div>
                <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        Tanggal Dibuat
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        {{ $category->created_at->format('d M Y, H:i') }}
                    </dd>
                </div>
            </dl>
        </div>
    </div>
</x-app-layout>
