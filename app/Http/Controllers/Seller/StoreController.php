<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Store;
use App\Http\Requests\StoreStoreRequest;
use App\Http\Requests\UpdateStoreRequest;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stores = Store::where('user_id', auth()->id())->paginate(10);
        return view('seller.stores.index', compact('stores'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('seller.stores.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStoreRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->id();
        Store::create($data);
        return redirect()->route('seller.stores.index')->with('success', 'Toko berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Store $store)
    {
        $this->authorizeStoreAccess($store);
        return view('seller.stores.show', compact('store'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Store $store)
    {
        $this->authorizeStoreAccess($store);
        return view('seller.stores.edit', compact('store'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStoreRequest $request, Store $store)
    {
        $this->authorizeStoreAccess($store);
        $store->update($request->validated());
        return redirect()->route('seller.stores.index')->with('success', 'Toko berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Store $store)
    {
        $this->authorizeStoreAccess($store);
        $store->delete();
        return redirect()->route('seller.stores.index')->with('success', 'Toko berhasil dihapus.');
    }

    private function authorizeStoreAccess(Store $store)
    {
        if ($store->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }
    }
}
