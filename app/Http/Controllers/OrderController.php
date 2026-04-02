<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = \App\Models\Order::where('user_id', auth()->id())->latest()->get();
        return view('orders.index', compact('orders'));
    }

    public function cancel(\App\Models\Order $order)
    {
        if ($order->user_id !== auth()->id()) abort(403);
        
        if (in_array($order->status, ['pending', 'processing'])) {
            $order->update(['status' => 'cancelled']);
            // Add shiprocket cancellation here if already shipped? 
            // For now, simple local cancel. Shiprocket sync happens via Admin usually or automated.
            return redirect()->back()->with('success', 'Order cancelled successfully.');
        }

        return redirect()->back()->with('error', 'Order cannot be cancelled.');
    }

    public function requestReturn(Request $request, \App\Models\Order $order)
    {
        if ($order->user_id !== auth()->id()) abort(403);
        
        if ($order->status == 'completed' && !$order->return_status) {
            $request->validate(['reason' => 'required|string']);
            
            $order->update([
                'return_status' => 'requested',
                'return_reason' => $request->reason
            ]);
            
            return redirect()->back()->with('success', 'Return request submitted.');
        }

        return redirect()->back()->with('error', 'Return cannot be requested.');
    }
}
