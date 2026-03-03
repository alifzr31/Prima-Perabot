<?php

namespace App\Http\Controllers\EComm;

use App\Http\Controllers\Controller;
use App\Models\Checkout;
use App\Models\CheckoutItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CheckoutController extends Controller
{
    public function index()
    {
        $response = Http::get('https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json');
        $provinces = $response->json();

        return view('customer.pages.checkout.index', compact('provinces'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'orderer_name' => 'required|string|max:255',
            'orderer_email' => 'required|email',
            'orderer_phone' => 'required|string',
            'receiver_name' => 'required|string',
            'receiver_address' => 'required|string',
            'receiver_country' => 'required|string',
            'receiver_province' => 'required|string',
            'receiver_city' => 'required|string',
            'receiver_district' => 'required|string',
            'receiver_sub_district' => 'required|string',
            'receiver_postal_code' => 'required|string',
            'notes' => 'nullable|string',
            'items' => 'array|min:1',
            'items.*.product_id' => 'exists:products,id',
            'items.*.qty' => 'integer|min:1',
        ]);

        try {
            $result = DB::transaction(function () use ($validated) {

                $subtotal = 0;
                $totalDiscount = 0;

                $orderNumber = 'ORD-' . now()->format('YmdHis') . rand(100, 999);

                // 1️⃣ Buat checkout (total sementara 0)
                $checkout = Checkout::create([
                    'order_number' => $orderNumber,
                    'orderer_name' => $validated['orderer_name'],
                    'orderer_email' => $validated['orderer_email'],
                    'orderer_phone' => $validated['orderer_phone'],
                    'receiver_name' => $validated['receiver_name'],
                    'receiver_address' => $validated['receiver_address'],
                    'receiver_country' => $validated['receiver_country'],
                    'receiver_province' => $validated['receiver_province'],
                    'receiver_city' => $validated['receiver_city'],
                    'receiver_district' => $validated['receiver_district'],
                    'receiver_sub_district' => $validated['receiver_sub_district'],
                    'receiver_postal_code' => $validated['receiver_postal_code'],
                    'notes' => $validated['notes'] ?? null,
                    'subtotal' => 0,
                    'total_discount_amount' => 0,
                    'grand_total' => 0,
                ]);

                // 2️⃣ Loop items
                foreach ($validated['items'] as $item) {
                    $product = Product::lockForUpdate()
                        ->findOrFail($item['product_id']);

                    $qty = $item['qty'];

                    // 🔒 Validasi stok
                    if ($product->stock < $qty) {
                        throw new \Exception("Stok produk {$product->name} tidak mencukupi.");
                    }

                    $price = $product->price;
                    $discountPercent = $product->discount_percent ?? 0;

                    $discountPerItem = intval($price * $discountPercent / 100);

                    $itemSubtotalBeforeDiscount = $price * $qty;
                    $itemDiscountTotal = $discountPerItem * $qty;
                    $itemFinalSubtotal = ($price - $discountPerItem) * $qty;

                    $subtotal += $itemSubtotalBeforeDiscount;
                    $totalDiscount += $itemDiscountTotal;

                    // 🔻 Kurangi stok
                    // $product->decrement('stock', $qty);

                    // 💾 Simpan snapshot item
                    CheckoutItem::create([
                        'checkout_id' => $checkout->id,
                        'product_id' => $product->id,
                        'product_name' => $product->name,
                        'price' => $price,
                        'discount_percent' => $discountPercent,
                        'discount_amount' => $discountPerItem,
                        'qty' => $qty,
                        'subtotal' => $itemFinalSubtotal,
                    ]);
                }

                $grandTotal = $subtotal - $totalDiscount;

                // 3️⃣ Update total checkout
                $checkout->update([
                    'subtotal' => $subtotal,
                    'total_discount_amount' => $totalDiscount,
                    'grand_total' => $grandTotal,
                ]);

                return [
                    'order_number' => $orderNumber,
                    'grand_total' => $grandTotal,
                    'checkout_data' => $checkout->load('checkoutItems.product'),
                ];
            });

            return response()->json([
                'success' => true,
                'message' => 'Checkout berhasil',
                'data' => $result,
            ], 201);
        } catch (\Throwable $e) {
            Log::error('Checkout Error: ' . $e->getMessage());

            return response()->json([
                'message' => 'Terjadi kesalahan saat proses checkout'
            ], 500);
        }
    }
}
