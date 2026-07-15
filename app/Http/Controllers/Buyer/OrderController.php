<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Cart;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::where('user_id', auth()->id())
            ->with(['store', 'orderItems'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);
            
        return view('buyer.orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $carts = Cart::where('user_id', auth()->id())->with('product.store')->get();
        if ($carts->isEmpty()) {
            return redirect()->route('buyer.carts.index')->with('error', 'Keranjang Anda kosong.');
        }

        $total = $carts->sum(fn($cart) => $cart->product->base_price * $cart->quantity);
        return view('buyer.orders.create', compact('carts', 'total'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrderRequest $request)
    {
        $carts = Cart::where('user_id', auth()->id())->with('product')->get();
        
        if ($carts->isEmpty()) {
            return redirect()->route('buyer.carts.index')->with('error', 'Keranjang Anda kosong.');
        }

        DB::beginTransaction();
        try {
            // Group carts by store_id
            $cartsByStore = $carts->groupBy(fn($cart) => $cart->product->store_id);
            
            // Assume flat shipping cost per store for now
            $shippingCost = 15000; 

            foreach ($cartsByStore as $storeId => $storeCarts) {
                $subtotal = $storeCarts->sum(fn($c) => $c->product->base_price * $c->quantity);
                $totalAmount = $subtotal + $shippingCost;

                // Create Order
                $order = Order::create([
                    'user_id' => auth()->id(),
                    'store_id' => $storeId,
                    'subtotal' => $subtotal,
                    'shipping_cost' => $shippingCost,
                    'total_amount' => $totalAmount,
                    'status' => 'Menunggu Pembayaran',
                    'shipping_address' => $request->shipping_address,
                ]);

                // Create Order Items and Reduce Stock
                foreach ($storeCarts as $cart) {
                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $cart->product_id,
                        'quantity' => $cart->quantity,
                        'price' => $cart->product->base_price,
                    ]);

                    // Decrease stock
                    $cart->product->decrement('stock', $cart->quantity);
                }
            }

            // Clear user's cart
            Cart::where('user_id', auth()->id())->delete();

            DB::commit();
            return redirect()->route('buyer.orders.index')->with('success', 'Pesanan berhasil dibuat. Silakan lakukan pembayaran.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memproses pesanan: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        $this->authorizeOrderAccess($order);
        $order->load(['store', 'orderItems.product']);
        return view('buyer.orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        // Buyer might upload payment proof
        $this->authorizeOrderAccess($order);
        return view('buyer.orders.edit', compact('order'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        $this->authorizeOrderAccess($order);
        
        $validated = $request->validate([
            'payment_proof' => 'required|string|max:255',
        ]);
        
        // When payment proof is uploaded, status becomes paid
        $order->update([
            'payment_proof' => $validated['payment_proof'],
            'status' => 'Menunggu Verifikasi'
        ]);
        
        return redirect()->route('buyer.orders.show', $order->id)->with('success', 'Bukti pembayaran berhasil diunggah.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        abort(404);
    }

    private function authorizeOrderAccess(Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }
    }

    /**
     * Laporan 8: Riwayat Pembelian Pelanggan (PDF)
     */
    public function historyPdf()
    {
        $orders = Order::where('user_id', auth()->id())
            ->where('status', 'Selesai')
            ->with(['store', 'orderItems.product'])
            ->orderBy('created_at', 'desc')
            ->get();

        $pdf = Pdf::loadView('pdf.order-history', compact('orders'));
        return $pdf->download('laporan-riwayat-pembelian.pdf');
    }

    /**
     * Laporan 10: Cetak Invoice (PDF)
     */
    public function invoicePdf(Order $order)
    {
        $this->authorizeOrderAccess($order);
        $order->load(['store', 'orderItems.product']);

        $pdf = Pdf::loadView('pdf.invoice', compact('order'));
        return $pdf->download('invoice-INV' . $order->id . '.pdf');
    }
}
