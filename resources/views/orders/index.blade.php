@extends('layouts.store')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-md-12">
            <h2>My Orders</h2>
            @if($orders->count() > 0)
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Total</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->created_at->format('d M Y') }}</td>
                                <td>{{ ucfirst($order->status) }} 
                                    @if($order->return_status)
                                        <br><span class="badge bg-warning">{{ ucfirst($order->return_status) }}</span>
                                    @endif
                                </td>
                                <td>Rs {{ number_format($order->total_amount, 2) }}</td>
                                <td>
                                    {{-- Cancel Button --}}
                                    @if(in_array($order->status, ['pending', 'processing']) && !$order->shiprocket_order_id)
                                        <form action="{{ route('orders.cancel', $order) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?');">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-danger">Cancel</button>
                                        </form>
                                    @endif

                                    {{-- Return Button --}}
                                    @if($order->status == 'completed' && !$order->return_status)
                                         <button type="button" class="btn btn-sm btn-warning" onclick="requestReturn({{ $order->id }})">Return</button>

                                         <form id="return-form-{{ $order->id }}" action="{{ route('orders.return', $order) }}" method="POST" style="display:none;">
                                            @csrf
                                            <input type="hidden" name="reason" id="return-reason-{{ $order->id }}">
                                         </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p>No orders found.</p>
                <a href="{{ route('shop') }}" class="btn btn-primary">Shop Now</a>
            @endif
        </div>
    </div>
</div>
<script>
    function requestReturn(orderId) {
        let reason = prompt("Please enter the reason for return:");
        if (reason) {
            document.getElementById('return-reason-' + orderId).value = reason;
            document.getElementById('return-form-' + orderId).submit();
        }
    }
</script>
@endsection
