<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use App\Http\Requests\StoreWishlistRequest;
use App\Http\Requests\UpdateWishlistRequest;

class WishlistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $wishlists = Wishlist::with('product')->where('user_id', auth()->id())->paginate(12);
        return view('buyer.wishlists.index', compact('wishlists'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort(404);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreWishlistRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->id();
        
        Wishlist::firstOrCreate($data);
        
        return back()->with('success', 'Produk ditambahkan ke wishlist.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Wishlist $wishlist)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Wishlist $wishlist)
    {
        abort(404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateWishlistRequest $request, Wishlist $wishlist)
    {
        abort(404);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Wishlist $wishlist)
    {
        $this->authorizeWishlistAccess($wishlist);
        $wishlist->delete();
        return back()->with('success', 'Produk dihapus dari wishlist.');
    }

    private function authorizeWishlistAccess(Wishlist $wishlist)
    {
        if ($wishlist->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }
    }
}
