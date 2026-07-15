<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Http\Requests\StoreCartRequest;
use App\Http\Requests\UpdateCartRequest;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $carts = Cart::with('product')->where('user_id', auth()->id())->get();
        return view('buyer.carts.index', compact('carts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Typically not used directly. Carts are added from Product page.
        abort(404);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCartRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->id();
        
        $cart = Cart::where('user_id', auth()->id())
                    ->where('product_id', $data['product_id'])
                    ->first();
                    
        if ($cart) {
            $cart->increment('quantity', $data['quantity']);
        } else {
            Cart::create($data);
        }
        
        return back()->with('success', 'Produk berhasil ditambahkan ke keranjang.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Cart $cart)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cart $cart)
    {
        abort(404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCartRequest $request, Cart $cart)
    {
        $this->authorizeCartAccess($cart);
        $cart->update($request->validated());
        return redirect()->route('buyer.carts.index')->with('success', 'Keranjang berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cart $cart)
    {
        $this->authorizeCartAccess($cart);
        $cart->delete();
        return redirect()->route('buyer.carts.index')->with('success', 'Produk dihapus dari keranjang.');
    }

    private function authorizeCartAccess(Cart $cart)
    {
        if ($cart->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }
    }
}
