<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Detail Tarif Pengiriman') }}
            </h2>
            <div class="flex space-x-3">
                <a href="{{ route('admin.shipping-rates.edit', $shippingRate->id) }}" class="px-4 py-2 bg-amber-500 text-white rounded-md text-sm font-medium hover:bg-amber-600 transition">
                    Edit Tarif
                </a>
                <a href="{{ route('admin.shipping-rates.index') }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md text-sm font-medium hover:bg-gray-300 transition">
                    Kembali
                </a>
            </div>
        </div>
    </x-slot>

    <div class="max-w-3xl mx-auto bg-white overflow-hidden shadow rounded-lg border border-gray-200">
        <div class="px-4 py-5 sm:px-6">
            <h3 class="text-lg leading-6 font-medium text-gray-900">
                Informasi Tarif Pengiriman
            </h3>
            <p class="mt-1 max-w-2xl text-sm text-gray-500">
                Detail tarif pengiriman per provinsi dan kota.
            </p>
        </div>
        <div class="border-t border-gray-200 px-4 py-5 sm:p-0">
            <dl class="sm:divide-y sm:divide-gray-200">
                <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        Provinsi
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        {{ $shippingRate->province }}
                    </dd>
                </div>
                <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        Kota/Kabupaten
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        {{ $shippingRate->city }}
                    </dd>
                </div>
                <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        Tarif
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        Rp {{ number_format($shippingRate->cost, 0, ',', '.') }}
                    </dd>
                </div>
            </dl>
        </div>
    </div>
</x-app-layout>
