<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\v1\Order;  // Model untuk memperbarui status order
use Illuminate\Support\Facades\Log;

class DokuController extends Controller
{
  public function handleCallback(Request $request)
{
    $data = $request->all();

    // Log raw callback data
    Log::info('Raw Callback Data: ' . json_encode($data, JSON_PRETTY_PRINT));

    // Cek apakah data yang dibutuhkan tersedia
    if (isset($data['transaction_status']) && isset($data['product_id'])) {
        $status = $data['transaction_status'];
        $product_id = $data['product_id'];

        Log::info("Transaction Status: $status, Product ID: $product_id");

        // Cari order berdasarkan product_id
        $order = Order::where('product_id', $product_id)->first();

        if ($order) {
            // Perbarui status berdasarkan transaction_status
            if ($status === 'SUCCESS') {
                $order->status = 'selesai';
                $order->payment = 'aprove';
            } elseif ($status === 'FAILED') {
                $order->status = 'pending';
                $order->payment = 'gagal';
            }

            // Simpan perubahan
            if ($order->save()) {
                Log::info("Order {$order->id} updated successfully.");
            } else {
                Log::error("Failed to update order {$order->id}.");
            }
        } else {
            Log::warning("Order not found with product_id: $product_id");
        }
    } else {
        Log::warning('Transaction status or product_id missing in callback data');
    }
    
    return redirect()->route('history.index');
    //return response()->json(['status' => 'success'], 200);
}

}

?>