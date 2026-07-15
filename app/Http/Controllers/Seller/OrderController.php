<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use Barryvdh\DomPDF\Facade\Pdf;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::whereHas('store', function($q) {
            $q->where('user_id', auth()->id());
        })->with(['user', 'orderItems'])->orderBy('created_at', 'desc')->paginate(10);
        
        return view('seller.orders.index', compact('orders'));
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
    public function store(StoreOrderRequest $request)
    {
        abort(404);
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        $this->authorizeOrderAccess($order);
        $order->load(['user', 'orderItems.product']);
        return view('seller.orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        $this->authorizeOrderAccess($order);
        return view('seller.orders.edit', compact('order'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        $this->authorizeOrderAccess($order);
        
        // Custom update for seller (usually status and resi)
        $validated = $request->validate([
            'status' => 'required|in:pending,paid,processing,shipped,completed,cancelled',
            'receipt_number' => 'nullable|string|max:255',
        ]);
        
        $order->update($validated);
        
        return redirect()->route('seller.orders.show', $order->id)->with('success', 'Status pesanan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        abort(404); // Usually orders shouldn't be deleted by seller, maybe cancelled.
    }

    private function authorizeOrderAccess(Order $order)
    {
        if ($order->store->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }
    }

    /**
     * Laporan 10: Cetak Invoice (PDF)
     */
    public function invoicePdf(Order $order)
    {
        $this->authorizeOrderAccess($order);
        $order->load(['user', 'orderItems.product']);

        $pdf = Pdf::loadView('pdf.invoice', compact('order'));
        return $pdf->download('invoice-INV' . $order->id . '.pdf');
    }
}
