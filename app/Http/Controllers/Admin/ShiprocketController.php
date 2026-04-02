<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Services\ShiprocketService;
use Illuminate\Http\Request;

class ShiprocketController extends Controller
{
    protected $shiprocket;

    public function __construct(ShiprocketService $shiprocket)
    {
        $this->shiprocket = $shiprocket;
    }

    public function ship(Order $order)
    {
        if ($order->shiprocket_order_id) {
            return redirect()->back()->with('error', 'Order already shipped via Shiprocket (ID: ' . $order->shiprocket_order_id . ')');
        }

        $response = $this->shiprocket->createOrder($order);

        if (isset($response['order_id'])) {
            $order->update([
                'shiprocket_order_id' => $response['order_id'],
                'shiprocket_shipment_id' => $response['shipment_id'] ?? null,
                'status' => 'processing' // Optional: auto-update status
            ]);

            return redirect()->back()->with('success', 'Order successfully created on Shiprocket. ID: ' . $response['order_id']);
        } elseif (isset($response['error'])) {
             return redirect()->back()->with('error', 'Shiprocket Error: ' . $response['error']);
        } else {
             // Handle validation errors from Shiprocket (usually in 'message' or 'errors')
             $msg = $response['message'] ?? 'Unknown error from Shiprocket';
             if(isset($response['errors'])){
                 $msg .= ' ' . json_encode($response['errors']);
             }
             return redirect()->back()->with('error', 'Shiprocket Error: ' . $msg);
        }
    }
    public function approveReturn(Order $order)
    {
        if ($order->return_status != 'requested') {
            return redirect()->back()->with('error', 'Return not requested or already processed.');
        }

        $response = $this->shiprocket->createReturnOrder($order);

        if (isset($response['order_id'])) {
            $order->update([
                'return_status' => 'approved',
                // You might want to save the return shipment ID too if you had a column
            ]);
            return redirect()->back()->with('success', 'Return approved and Reverse Pickup created (ID: ' . $response['order_id'] . ')');
        } elseif (isset($response['error'])) {
             return redirect()->back()->with('error', 'Shiprocket Error: ' . $response['error']);
        } else {
             $msg = $response['message'] ?? 'Unknown error';
             if(isset($response['errors'])){
                 $msg .= ' ' . json_encode($response['errors']);
             }
             return redirect()->back()->with('error', 'Shiprocket Error: ' . $msg);
        }
    }
}
