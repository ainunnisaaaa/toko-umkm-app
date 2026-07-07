<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ShippingRate;
use App\Http\Requests\StoreShippingRateRequest;
use App\Http\Requests\UpdateShippingRateRequest;

class ShippingRateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $shippingRates = ShippingRate::latest()->paginate(10);
        return view('admin.shipping_rates.index', compact('shippingRates'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.shipping_rates.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreShippingRateRequest $request)
    {
        $validated = $request->validated();
        ShippingRate::create($validated);
        return redirect()->route('admin.shipping-rates.index')->with('success', 'Tarif berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(ShippingRate $shippingRate)
    {
        return view('admin.shipping_rates.show', compact('shippingRate'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ShippingRate $shippingRate)
    {
        return view('admin.shipping_rates.edit', compact('shippingRate'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateShippingRateRequest $request, ShippingRate $shippingRate)
    {
        $validated = $request->validated();
        $shippingRate->update($validated);
        return redirect()->route('admin.shipping-rates.index')->with('success', 'Tarif berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ShippingRate $shippingRate)
    {
        $shippingRate->delete();
        return redirect()->route('admin.shipping-rates.index')->with('success', 'Tarif berhasil dihapus.');
    }
}
