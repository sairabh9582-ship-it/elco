@extends('layouts.admin')

@section('content')
<div class="container-fluid content-inner pb-0">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Order Details #{{ $order->id }}</h4>
                    </div>
                    <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">Back to Orders</a>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Customer Details</h5>
                            <p><strong>Name:</strong> {{ $order->first_name }} {{ $order->last_name }}</p>
                            <p><strong>Email:</strong> {{ $order->email }}</p>
                            <p><strong>Phone:</strong> {{ $order->phone }}</p>
                        </div>
                        <div class="col-md-6">
                            <h5>Shipping Address</h5>
                            <p>
                                {{ $order->address }}<br>
                                {{ $order->city }}, {{ $order->post_code }}<br>
                                {{ $order->country }}
                            </p>
                            
                            <hr class="my-4">
                            
                            <h5>Update Status</h5>
                            @if($order->status == 'paid')
                                <div class="alert alert-success">
                                    <strong>Status:</strong> Paid
                                </div>
                            @else
                                <form action="{{ route('admin.orders.updateStatus', $order) }}" method="POST" class="d-flex align-items-center">
                                    @csrf
                                    @method('PUT')
                                    <select name="status" class="form-select me-2">
                                        <option value="unpaid" {{ $order->status == 'unpaid' || $order->status == 'pending' ? 'selected' : '' }}>Unpaid</option>
                                        <option value="paid" {{ $order->status == 'paid' ? 'selected' : '' }}>Paid</option>
                                    </select>
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </form>
                            @endif

                            <hr class="my-4">

                            <h5>Shipping (Shiprocket)</h5>
                            @if($order->shiprocket_order_id)
                                <div class="alert alert-success">
                                    <strong>Shipped!</strong><br>
                                    Order ID: {{ $order->shiprocket_order_id }}<br>
                                    @if($order->shiprocket_shipment_id)
                                    Shipment ID: {{ $order->shiprocket_shipment_id }}
                                    @endif
                                </div>
                            @else
                                <form action="{{ route('admin.orders.ship', $order) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-info text-white">
                                        <i class="fas fa-truck"></i> Ship with Shiprocket
                                    </button>
                                </form>
                            @endif

                            @if($order->return_status)
                                <hr class="my-4">
                                <h5>Return Status</h5>
                                <div class="alert alert-warning">
                                    <strong>Status:</strong> {{ ucfirst($order->return_status) }}<br>
                                    @if($order->return_reason) <strong>Reason:</strong> {{ $order->return_reason }} @endif
                                </div>
                                @if($order->return_status == 'requested')
                                    <form action="{{ route('admin.orders.approveReturn', $order) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-danger">
                                            <i class="fas fa-undo"></i> Approve Return & Create Pickup
                                        </button>
                                    </form>
                                @endif
                                @if($order->return_status == 'approved')
                                    <div class="alert alert-info mt-2">
                                        Reverse Pickup Created on Shiprocket.
                                    </div>
                                @endif
                            @endif
                        </div>
                    </div>
                    
                    <hr>
                    
                    <h5>Order Items</h5>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order->items as $item)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            @if($item->product && $item->product->image)
                                            <img src="{{ asset($item->product->image) }}" class="img-fluid rounded me-2" style="width: 50px; height: 50px;">
                                            @endif
                                            {{ $item->product->name ?? 'Product Deleted' }}
                                        </div>
                                    </td>
                                    <td>{{ $siteSetting->currency ?? '₹' }}{{ number_format($item->price, 2) }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>{{ $siteSetting->currency ?? '₹' }}{{ number_format($item->price * $item->quantity, 2) }}</td>
                                </tr>
                                @endforeach
                                <tr>
                                    <td colspan="3" class="text-end"><strong>Total Amount:</strong></td>
                                    <td><strong>{{ $siteSetting->currency ?? '₹' }}{{ number_format($order->total_amount, 2) }}</strong></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
