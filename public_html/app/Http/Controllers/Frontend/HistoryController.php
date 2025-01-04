<?php
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\V1\Order;
use Illuminate\Http\Request;

// class HistoryController extends Controller
// {
//     public function index()
//     {
//         // Fetch orders with product details
//         $orders = Order::with('product') // Load the product relationship
//             ->whereIn('payment', ['aprove', 'pending', 'gagal']) // Filter by payment status
//             ->whereIn('status', ['pending', 'proses', 'mengirim', 'selesai']) // Filter by order status
//             ->get();

//         // Return the view with the orders data
//         return view('home.history.index', compact('orders'));
//     }
// }

class HistoryController extends Controller
{
    public function index()
    {
        // Fetch orders with product details
        $orders = Order::with('product') // Load the product relationship
            ->where('payment', 'approve') // Filter only 'approve' payment status
            ->where('status', 'approve')  // Filter only 'approve' status
            ->get();

        // Return the view with the orders data
        return view('home.history.index', compact('orders'));
    }
}
