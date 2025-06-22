<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use Midtrans\Snap;
use Midtrans\Config;
use Illuminate\Support\Str;

class MidtransController extends Controller
{
    public function __construct()
    {
        // Konfigurasi Midtrans
        Config::$serverKey = config('midtrans.serverKey');
        Config::$isProduction = false; // true kalau sudah live
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }

    public function payment(Request $request)
    {
        $user = auth()->user();
        $cartItems = Cart::where('user_id', $user->id)->whereNull('order_id')->get();

        if ($cartItems->isEmpty()) {
            return redirect()->back()->with('error', 'Keranjang kamu kosong');
        }

        $grossAmount = 0;
        $items = [];

        foreach ($cartItems as $item) {
            $product = Product::find($item->product_id);
            $items[] = [
                'id' => $product->id,
                'price' => $item->price,
                'quantity' => $item->quantity,
                'name' => $product->title,
            ];
            $grossAmount += $item->price * $item->quantity;
        }

        $orderId = 'INV-' . strtoupper(Str::random(10));

        // Simpan order ke database (opsional, bisa juga setelah pembayaran sukses)
        $order = Order::create([
            'order_number' => $orderId,
            'user_id' => $user->id,
            'sub_total' => $grossAmount,
            'shipping_id' => null,
            'total_amount' => $grossAmount,
            'quantity' => $cartItems->sum('quantity'),
            'payment_method' => 'midtrans',
            'payment_status' => 'unpaid',
            'status' => 'new',
            'first_name' => $user->name,
            'last_name' => '', 
            'email' => $user->email,
            'phone' => '08xxxxx',
            'country' => 'Indonesia',
            'post_code' => '12345',
            'address1' => 'Alamat default',
            'address2' => '',
        ]);
        

        // Hubungkan cart ke order
        foreach ($cartItems as $item) {
            $item->order_id = $order->id;
            $item->save();
        }

        // Simpan ke session untuk redirect success
        session()->put('midtrans_order_id', $order->id);

        // Data Snap
        $params = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => $grossAmount,
            ],
            'customer_details' => [
                'first_name' => $user->name,
                'email' => $user->email,
                'phone' => '08xxxxx',
            ],
            'item_details' => $items,
        ];

        $snapToken = Snap::getSnapToken($params);

        return view('frontend.pages.midtrans', compact('snapToken'));
    }

    public function success(Request $request)
    {
        // Ambil ID order dari session
        $orderId = session()->get('midtrans_order_id');

        if (!$orderId) {
            return redirect('/')->with('error', 'Tidak ada data pembayaran ditemukan');
        }

        $order = Order::findOrFail($orderId);
        $order->payment_status = 'paid';
        $order->status = 'process';
        $order->save();

        session()->forget('midtrans_order_id');
        session()->forget('cart');
        session()->forget('coupon');

        return redirect('/')->with('success', 'Pembayaran berhasil!');
    }
}
