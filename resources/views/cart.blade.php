@extends('layouts.store')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">Shopping Cart</h2>
    
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(count($cart) > 0)
    <div class="row">
        <!-- Left Column: Cart Details -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0 align-middle">
                            <thead class="bg-light">
                                <tr>
                                    <th class="ps-4 py-3" style="width: 40%;">Product</th>
                                    <th class="py-3" style="width: 15%;">Price</th>
                                    <th class="py-3" style="width: 20%;">Quantity</th>
                                    <th class="py-3 text-end" style="width: 15%;">Subtotal</th>
                                    <th class="py-3 text-end pe-4" style="width: 10%;"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($cart as $id => $details)
                                    <tr data-id="{{ $id }}">
                                        <td class="ps-4 py-3">
                                            <div class="d-flex align-items-center">
                                                <div class="me-3" style="width: 60px; height: 60px; flex-shrink: 0; background-color: #f8f9fa; display: flex; align-items: center; justify-content: center; border-radius: 8px; overflow: hidden;">
                                                    @if($details['image'])
                                                        <img src="{{ asset($details['image']) }}" alt="{{ $details['name'] }}" style="max-width: 100%; max-height: 100%;">
                                                    @else
                                                        <i class="fas fa-image text-secondary"></i>
                                                    @endif
                                                </div>
                                                <div>
                                                    <h6 class="mb-0 text-truncate" style="max-width: 200px;">{{ $details['name'] }}</h6>
                                                    <small class="text-muted">In House</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="py-3">{{ $siteSetting->currency ?? '₹' }}{{ $details['price'] }}</td>
                                        <td class="py-3">
                                            <div class="input-group input-group-sm" style="width: 100px;">
                                                <input type="number" value="{{ $details['quantity'] }}" class="form-control quantity update-cart text-center" min="1">
                                            </div>
                                        </td>
                                        <td class="py-3 text-end fw-bold">{{ $siteSetting->currency ?? '₹' }}{{ $details['price'] * $details['quantity'] }}</td>
                                        <td class="py-3 text-end pe-4">
                                            <button type="button" class="btn btn-link text-danger p-0 remove-from-cart" data-id="{{ $id }}" onclick="removeCartItem(this)">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer bg-white border-0 py-3 text-end">
                     <a href="{{ route('shop') }}" class="btn btn-outline-warning"><i class="fa fa-angle-left me-2"></i> Continue Shopping</a>
                </div>
            </div>
        </div>

        <!-- Right Column: Order Summary -->
        <div class="col-lg-4 mt-4 mt-lg-0">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0 py-3">
                    <h5 class="mb-0 fw-bold">Order Summary</h5>
                </div>
                <div class="card-body pt-0">
                    <div class="d-flex justify-content-between align-items-center bg-primary text-white p-3 rounded mb-3">
                        <span class="fw-bold">Total Products</span>
                        <span class="fw-bold">{{ count($cart) }}</span>
                    </div>
                    
                    <div class="d-flex justify-content-between mb-2 text-muted">
                        <span>Subtotal</span>
                        <span>{{ $siteSetting->currency ?? '₹' }}{{ number_format($subtotal, 2) }}</span>
                    </div>
                    
                    @if(isset($discount) && $discount > 0)
                    <div class="d-flex justify-content-between mb-2 text-success">
                        <span>Discount <small>({{ $coupon_code ?? '' }})</small></span>
                        <span>- {{ $siteSetting->currency ?? '₹' }}{{ number_format($discount, 2) }}</span>
                    </div>
                    @endif

                    <!-- Tax placeholder -->
                    <div class="d-flex justify-content-between mb-3 text-muted">
                        <span>Tax</span>
                        <span>{{ $siteSetting->currency ?? '₹' }}0.00</span>
                    </div>

                    <hr class="my-3">

                    <div class="d-flex justify-content-between mb-4">
                        <span class="h5 fw-bold text-dark">TOTAL</span>
                        <span class="h5 fw-bold text-primary">{{ $siteSetting->currency ?? '₹' }}{{ number_format($total, 2) }}</span>
                    </div>

                    <!-- Coupon Input -->
                    <div class="mb-3">
                        <form action="{{ route('apply.coupon') }}" method="POST">
                            @csrf
                            <div class="input-group">
                                <input type="text" name="coupon_code" class="form-control" placeholder="Have coupon code?" value="{{ $coupon_code ?? '' }}" {{ isset($coupon_code) ? 'disabled' : '' }}>
                                @if(isset($coupon_code))
                                    <!-- Optional: Route to remove coupon could be added here -->
                                    <button class="btn btn-secondary" type="button" disabled>Applied</button>
                                @else
                                    <button class="btn btn-primary" type="submit">Apply</button>
                                @endif
                            </div>
                        </form>
                    </div>

                    <a href="{{ route('checkout') }}{{ isset($coupon_code) ? '?coupon_code=' . $coupon_code : '' }}" class="btn btn-primary w-100 py-2 fw-bold text-uppercase">Proceed to Checkout ({{ count($cart) }})</a>
                </div>
            </div>

            <!-- Available Coupons Logic moved here -->
             @if(isset($coupons) && $coupons->count() > 0)
                <div class="mt-4">
                    <h6 class="fw-bold text-muted mb-3"><i class="fas fa-ticket-alt me-2"></i>Available Coupons</h6>
                    @foreach($coupons as $coupon)
                        <div class="card border-info mb-2 coupon-clickable" data-code="{{ $coupon->code }}">
                            <div class="card-body p-2 d-flex align-items-center justify-content-between">
                                <div>
                                    <span class="badge bg-light text-primary border border-primary mb-1">{{ $coupon->code }}</span>
                                    <div class="small">
                                        @if($coupon->target_type == 'welcome')
                                            <span class="badge bg-warning text-dark me-1" style="font-size: 0.65rem;">Welcome</span>
                                        @endif
                                        Get 
                                        @if($coupon->type == 'percent')
                                            {{ $coupon->value }}% OFF
                                        @else
                                            {{ $siteSetting->currency ?? '₹' }}{{ $coupon->value }} OFF
                                        @endif
                                    </div>
                                    @if($coupon->min_spend)
                                        <div class="text-muted" style="font-size: 0.7rem;">Min Spend: {{ $siteSetting->currency ?? '₹' }}{{ $coupon->min_spend }}</div>
                                    @endif
                                </div>
                                <i class="far fa-copy text-muted"></i>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

        </div>
    </div>

    @section('scripts')
    <script type="text/javascript">
      
    function removeCartItem(element) {
        var ele = $(element);
        var id = ele.attr("data-id");

        if(!id) {
            console.error("ID not found for delete action");
            return;
        }

        if(confirm("Are you sure want to remove?")) {
            $.ajax({
                url: '{{ route('remove.from.cart') }}',
                method: "DELETE",
                data: {
                    _token: '{{ csrf_token() }}', 
                    id: id
                },
                success: function (response) {
                    window.location.reload();
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                    alert("Error removing item.");
                }
            });
        }
    }

    $(document).ready(function() {
        $(document).on("change", ".update-cart", function (e) {
            e.preventDefault();
            var ele = $(this);
            $.ajax({
                url: '{{ route('update.cart') }}',
                method: "patch",
                data: {
                    _token: '{{ csrf_token() }}', 
                    id: ele.closest("tr").attr("data-id"), 
                    quantity: ele.closest("tr").find(".quantity").val()
                },
                success: function (response) {
                   window.location.reload();
                }
            });
        });

        // Click to copy coupon code
        $('.coupon-clickable').on('click', function() {
            var code = $(this).data('code');
            var card = $(this);
            
            navigator.clipboard.writeText(code).then(function() {
                var originalBg = card.css('background-color');
                var originalBorder = card.css('border-color');
                
                card.css({
                    'background-color': '#d1e7dd',
                    'border-color': '#badbcc'
                });
                
                setTimeout(function() {
                    card.css({
                        'background-color': originalBg,
                        'border-color': originalBorder
                    });
                }, 500);

                Swal.fire({
                    title: 'Copied!',
                    text: 'Coupon code ' + code + ' copied.',
                    icon: 'success',
                    timer: 1500,
                    showConfirmButton: false,
                    toast: true,
                    position: 'top-end'
                });
            });
        });
    });
      
    </script>
    <style>
        .coupon-clickable {
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .coupon-clickable:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            background-color: #f0fff4 !important;
        }
    </style>
    @endsection

    @else
        <div class="text-center py-5">
            <div class="mb-4">
                <i class="fas fa-shopping-cart fa-4x text-muted opacity-25"></i>
            </div>
            <h3>Your cart is empty</h3>
            <p class="text-muted">Looks like you haven't added anything to your cart yet.</p>
            <a href="{{ route('shop') }}" class="btn btn-primary mt-3 px-4 rounded-pill">Start Shopping</a>
        </div>
    @endif
</div>
@endsection
