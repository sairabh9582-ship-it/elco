@extends('layouts.store')

@section('content')
<!-- Checkout Page Start -->
<div class="container-fluid py-5">
    <div class="container py-5">
        <h1 class="mb-4">Billing Details</h1>
        <form id="checkoutForm" action="{{ route('checkout.store') }}" method="POST">
            @csrf
            <div class="row g-5">
                <div class="col-md-12 col-lg-6 col-xl-7">
                    <div class="row">
                        <div class="col-md-12 col-lg-6">
                            <div class="form-item w-100">
                                <label class="form-label my-3">First Name<sup>*</sup></label>
                                <input type="text" class="form-control" name="first_name" required>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-6">
                            <div class="form-item w-100">
                                <label class="form-label my-3">Last Name<sup>*</sup></label>
                                <input type="text" class="form-control" name="last_name" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-item">
                        <label class="form-label my-3">Address <sup>*</sup></label>
                        <input type="text" class="form-control" name="address" placeholder="House Number Street Name" required>
                    </div>
                    <div class="form-item">
                        <label class="form-label my-3">Town/City<sup>*</sup></label>
                        <input type="text" class="form-control" name="city" required>
                    </div>
                    <div class="form-item">
                        <label class="form-label my-3">Country<sup>*</sup></label>
                        <input type="text" class="form-control" name="country" required>
                    </div>
                    <div class="form-item">
                        <label class="form-label my-3">Postcode/Zip<sup>*</sup></label>
                        <input type="text" class="form-control" name="post_code" required>
                    </div>
                    <div class="form-item">
                        <label class="form-label my-3">Mobile<sup>*</sup></label>
                        <input type="tel" class="form-control" name="phone" required>
                    </div>
                    <div class="form-item">
                        <label class="form-label my-3">Email Address<sup>*</sup></label>
                        <input type="email" class="form-control" name="email" required>
                    </div>
                </div>
                <div class="col-md-12 col-lg-6 col-xl-5">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Products</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($cart as $id => $details)
                                <tr>
                                    <th scope="row">
                                        <div class="d-flex align-items-center mt-2">
                                            <img src="{{ asset($details['image']) }}" class="img-fluid rounded-circle" style="width: 90px; height: 90px;" alt="">
                                        </div>
                                    </th>
                                    <td class="py-5">{{ $details['name'] }}</td>
                                    <td class="py-5">{{ $siteSetting->currency ?? '₹' }} {{ $details['price'] }}</td>
                                    <td class="py-5">{{ $details['quantity'] }}</td>
                                    <td class="py-5">{{ $siteSetting->currency ?? '₹' }} {{ $details['price'] * $details['quantity'] }}</td>
                                </tr>
                                @endforeach
                                <tr>
                                    <td colspan="4" class="text-end py-5">
                                        <p class="mb-0 text-dark py-3">Subtotal</p>
                                    </td>
                                    <td class="py-5">
                                        <div class="py-3 border-bottom border-top">
                                            <p class="mb-0 text-dark">{{ $siteSetting->currency ?? '₹' }}{{ number_format($subtotal, 2) }}</p>
                                        </div>
                                    </td>
                                </tr>
                                @if(isset($discount) && $discount > 0)
                                <tr>
                                    <td colspan="4" class="text-end py-5">
                                        <p class="mb-0 text-success py-3">Discount</p>
                                    </td>
                                    <td class="py-5">
                                        <div class="py-3 border-bottom border-top">
                                            <p class="mb-0 text-success">- {{ $siteSetting->currency ?? '₹' }}{{ number_format($discount, 2) }}</p>
                                        </div>
                                    </td>
                                </tr>
                                @endif
                                <tr>
                                    <td colspan="4" class="text-end py-5">
                                        <p class="mb-0 text-dark py-3">Total</p>
                                    </td>
                                    <td class="py-5">
                                        <div class="py-3 border-bottom border-top">
                                            <p class="mb-0 text-dark">{{ $siteSetting->currency ?? '₹' }}{{ number_format($total, 2) }}</p>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="row g-4 text-center align-items-center justify-content-center border-bottom py-3">
                        @foreach($gateways as $gateway)
                        <div class="col-12">
                            <div class="form-check text-start my-3">
                                <input type="radio" class="form-check-input bg-primary border-0" id="payment-{{ $gateway->id }}" name="payment_method" value="{{ $gateway->name }}" {{ $loop->first ? 'checked' : '' }}>
                                <label class="form-check-label" for="payment-{{ $gateway->id }}">{{ $gateway->name }}</label>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="row g-4 text-center align-items-center justify-content-center pt-4">
                        <button type="submit" class="btn border-secondary py-3 px-4 text-uppercase w-100 text-primary">Place Order</button>
                    </div>
                </div>
            </div>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- Checkout Page End -->

{{-- Load Payment Scripts if Addons are Active --}}
@php
    $razorpayActive = \App\Models\Addon::where('unique_identifier', 'razorpay')->where('status', true)->exists();
    $stripeActive = \App\Models\Addon::where('unique_identifier', 'stripe')->where('status', true)->exists();
    $paypalActive = \App\Models\Addon::where('unique_identifier', 'paypal')->where('status', true)->exists();
    $paypalClientId = \App\Models\PaymentGateway::where('code', 'paypal')->first()->settings['client_id'] ?? '';
@endphp

@if($razorpayActive)
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
@endif

@if($stripeActive)
    <script src="https://js.stripe.com/v3/"></script>
@endif

@if($paypalActive && $paypalClientId)
    <script src="https://www.paypal.com/sdk/js?client-id={{ $paypalClientId }}&currency=USD"></script>
    <div id="paypal-button-container" class="mt-3 d-none"></div>
@endif

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('checkoutForm');
        const placeOrderBtn = form.querySelector('button[type="submit"]');
        const paypalContainer = document.getElementById('paypal-button-container');

        // Handle Payment Selection Changes
        document.querySelectorAll('input[name="payment_method"]').forEach(radio => {
            radio.addEventListener('change', function() {
                if (this.value === 'PayPal') {
                    placeOrderBtn.classList.add('d-none');
                    paypalContainer.classList.remove('d-none');
                } else {
                    placeOrderBtn.classList.remove('d-none');
                    paypalContainer.classList.add('d-none');
                }
            });
        });

        // PayPal Integration
        if (typeof paypal !== 'undefined') {
            paypal.Buttons({
                createOrder: function(data, actions) {
                    return fetch('{{ route("checkout.paypal.create_order") }}', {
                        method: 'POST',
                        headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
                    }).then(res => res.json()).then(orderData => orderData.id);
                },
                onApprove: function(data, actions) {
                    return fetch('{{ route("checkout.paypal.capture_order") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ orderID: data.orderID })
                    }).then(res => res.json()).then(res => {
                        if (res.status === 'success') {
                            const input = document.createElement('input');
                            input.type = 'hidden';
                            input.name = 'paypal_order_id';
                            input.value = data.orderID;
                            form.appendChild(input);
                            form.submit();
                        } else {
                            alert('PayPal capture failed.');
                        }
                    });
                }
            }).render('#paypal-button-container');
        }

        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const selectedPayment = document.querySelector('input[name="payment_method"]:checked').value;
            
            if (selectedPayment === 'Razorpay') {
                fetch('{{ route("checkout.razorpay.order") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({})
                })
                .then(response => response.json())
                .then(data => {
                    if (data.error) { alert(data.error); return; }

                    const options = {
                        "key": data.key_id,
                        "amount": data.amount,
                        "currency": "INR",
                        "name": "{{ $siteSetting->site_name ?? 'Electro' }}",
                        "order_id": data.id, 
                        "handler": function (response){
                            const fields = ['razorpay_payment_id', 'header_razorpay_order_id', 'razorpay_signature'];
                            fields.forEach(f => {
                                let input = document.createElement('input');
                                input.type = 'hidden';
                                input.name = f;
                                input.value = response[f];
                                form.appendChild(input);
                            });
                            form.submit();
                        },
                        "prefill": {
                            "name": form.first_name.value + ' ' + form.last_name.value,
                            "email": form.email.value,
                            "contact": form.phone.value
                        }
                    };
                    (new Razorpay(options)).open();
                });
            } else if (selectedPayment === 'Stripe') {
                fetch('{{ route("checkout.stripe.create_session") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(res => res.json())
                .then(data => {
                    if (data.id) {
                        const stripe = Stripe(data.publishable_key);
                        stripe.redirectToCheckout({ sessionId: data.id });
                    } else {
                        alert(data.error);
                    }
                });
            } else if (selectedPayment === 'PhonePe') {
                fetch('{{ route("checkout.phonepe.pay") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(res => res.json())
                .then(data => {
                    if (data.url) {
                        window.location.href = data.url;
                    } else {
                        alert(data.error || 'PhonePe error');
                    }
                });
            } else if (selectedPayment === 'Paytm') {
                alert('Paytm gateway is registered. Please complete the form submission with Paytm details.');
                form.submit();
            } else {
                form.submit();
            }
        });
    });
</script>
@endsection
