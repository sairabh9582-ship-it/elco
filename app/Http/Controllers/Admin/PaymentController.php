<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PaymentGateway;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        $gateways = PaymentGateway::all();
        return view('admin.payments.index', compact('gateways'));
    }

    public function edit(PaymentGateway $payment)
    {
        return view('admin.payments.edit', compact('payment'));
    }

    public function update(Request $request, PaymentGateway $payment)
    {
        $data = $request->validate([
            'status' => 'boolean',
            'settings' => 'nullable|array',
        ]);

        $payment->update([
            'status' => $request->boolean('status'),
            'settings' => $request->settings,
        ]);

        return redirect()->route('admin.payments.index')->with('success', 'Payment gateway updated successfully.');
    }
}
