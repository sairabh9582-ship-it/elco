@extends('layouts.store')

@section('content')

<!-- Single Product Start -->
<div class="container-fluid py-5 mt-5">
    <div class="container py-5">
        <div class="row g-4 mb-5">
            <div class="col-lg-8 col-xl-9">
                <div class="row g-4">
                    <div class="col-lg-6">
                        <div class="border rounded">
                            <a href="#">
                                <img src="{{ asset($product->image) }}" class="img-fluid rounded" alt="Image">
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <h4 class="fw-bold mb-3">{{ $product->name }}</h4>
                        <p class="mb-3">Category: {{ $product->category->name ?? 'Uncategorized' }}</p>
                        <h5 class="fw-bold mb-3">
                            @if($product->old_price)
                                <del class="text-danger me-2">{{ $siteSetting->currency ?? '₹' }}{{ number_format($product->old_price, 2) }}</del>
                            @endif
                            <span class="text-primary h4 fw-bold">{{ $siteSetting->currency ?? '₹' }}{{ number_format($product->price, 2) }}</span>
                            @if($product->isWholesaleProduct())
                                <span class="badge bg-success ms-2" style="font-size: 0.7rem; vertical-align: middle;">Also Available for Wholesale</span>
                            @endif
                        </h5>

                        @if($product->isWholesaleProduct())
                            <div class="mb-4">
                                <button class="btn btn-sm btn-outline-primary" type="button" data-bs-toggle="collapse" data-bs-target="#wholesaleTiers" aria-expanded="false" aria-controls="wholesaleTiers">
                                    <i class="fas fa-layer-group me-2"></i>View Wholesale Pricing
                                </button>
                                <div class="collapse mt-3" id="wholesaleTiers">
                                    <div class="wholesale-tiers-card bg-light p-3 rounded border">
                                        <h6 class="fw-bold mb-3">Bulk Pricing (Wholesale)</h6>
                                        <div class="table-responsive">
                                            <table class="table table-sm table-borderless mb-0">
                                                <thead>
                                                    <tr class="text-muted" style="font-size: 0.85rem;">
                                                        <th>Quantity</th>
                                                        <th>Price Per Unit</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if($product->isWholesaleProduct())
                                                        @foreach($product->wholesalePrices()->orderBy('min_quantity', 'asc')->get() as $tier)
                                                            <tr>
                                                                <td>
                                                                    <span class="fw-bold">
                                                                        @if($tier->max_quantity)
                                                                            {{ $tier->min_quantity }} - {{ $tier->max_quantity }}
                                                                        @else
                                                                            {{ $tier->min_quantity }}+
                                                                        @endif
                                                                    </span> units
                                                                </td>
                                                                <td class="text-success fw-bold">
                                                                    {{ $siteSetting->currency ?? '₹' }}{{ number_format($tier->price, 2) }}
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="d-flex mb-4">
                            <i class="fa fa-star text-secondary"></i>
                            <i class="fa fa-star text-secondary"></i>
                            <i class="fa fa-star text-secondary"></i>
                            <i class="fa fa-star text-secondary"></i>
                            <i class="fa fa-star"></i>
                        </div>
                        <p class="mb-4">{{ $product->description ?? 'No description available for this product.' }}</p>

                        @if(isset($coupons) && $coupons->count() > 0)
                            <div class="mb-4">
                                <h6 class="fw-bold text-success"><i class="fas fa-ticket-alt me-2"></i>Available Coupons (Click to copy):</h6>
                                @foreach($coupons as $coupon)
                                    <div class="alert alert-light border-success text-success py-2 px-3 mb-2 d-inline-block w-100 coupon-card-clickable" role="alert" data-code="{{ $coupon->code }}" style="cursor: pointer; transition: 0.3s; position: relative;">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <span class="fw-bold border border-success rounded px-2 py-1 me-2 coupon-code" style="border-style: dashed !important;">{{ $coupon->code }}</span>
                                                <span>
                                                    Get 
                                                    @if($coupon->type == 'percent')
                                                        {{ $coupon->value }}% OFF
                                                    @else
                                                        {{ $siteSetting->currency ?? '₹' }}{{ number_format($coupon->value, 2) }} OFF
                                                    @endif
                                                </span>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                @if($coupon->min_spend)
                                                    <small class="text-muted me-3">Min: {{ $siteSetting->currency ?? '₹' }}{{ number_format($coupon->min_spend, 2) }}</small>
                                                @endif
                                                <i class="far fa-copy"></i>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                        <div class="input-group quantity mb-4" style="width: 100px;">
                            <div class="input-group-btn">
                                <button class="btn btn-sm btn-minus rounded-circle bg-light border" >
                                    <i class="fa fa-minus"></i>
                                </button>
                            </div>
                            <input type="text" id="product_quantity" class="form-control form-control-sm text-center border-0" value="1">
                            <div class="input-group-btn">
                                <button class="btn btn-sm btn-plus rounded-circle bg-light border">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>

                        <div class="total-price-display mb-4">
                            <h5 class="fw-bold">Total Price: <span id="total_price_amount" class="text-primary">{{ $siteSetting->currency ?? '₹' }}{{ number_format($product->price, 2) }}</span></h5>
                        </div>

                        <a href="{{ route('add.to.cart', $product->id) }}" id="add_to_cart_link" class="btn btn-primary border border-secondary rounded-pill px-4 py-2 mb-4"><i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>
                    </div>
                    <div class="col-lg-12">
                        <nav>
                            <div class="nav nav-tabs mb-3">
                                <button class="nav-link active border-white border-bottom-0" type="button" role="tab"
                                    id="nav-about-tab" data-bs-toggle="tab" data-bs-target="#nav-about"
                                    aria-controls="nav-about" aria-selected="true">Description</button>
                                <button class="nav-link border-white border-bottom-0" type="button" role="tab"
                                    id="nav-mission-tab" data-bs-toggle="tab" data-bs-target="#nav-mission"
                                    aria-controls="nav-mission" aria-selected="false">Reviews</button>
                            </div>
                        </nav>
                        <div class="tab-content mb-5">
                            <div class="tab-pane active" id="nav-about" role="tabpanel" aria-labelledby="nav-about-tab">
                                <p>{{ $product->description }}</p>
                            </div>
                            <div class="tab-pane" id="nav-mission" role="tabpanel" aria-labelledby="nav-mission-tab">
                                <p>Reviews will appear here.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-xl-3">
                <div class="row g-4 fruite">
                    <div class="col-lg-12">
                        <!-- Sidebar could go here -->
                         <div class="mb-3">
                            <h4>Categories</h4>
                            <ul class="list-unstyled fruite-categorie">
                                <li>
                                    <div class="d-flex justify-content-between fruite-name">
                                        <a href="#"><i class="fas fa-apple-alt me-2"></i>Computers</a>
                                        <span>(3)</span>
                                    </div>
                                </li>
                                <!-- Static for now since we don't have categories passed in globally fully yet -->
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Single Product End -->

@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        @php
            $wholesaleTiers = [];
            if ($product->isWholesaleProduct()) {
                $wholesaleTiers = $product->wholesalePrices()->orderBy('min_quantity', 'asc')->get()->map(function($tier) {
                    return [
                        'min' => $tier->min_quantity,
                        'max' => $tier->max_quantity,
                        'price' => $tier->price
                    ];
                });
            }
        @endphp
        var wholesalePrices = @json($wholesaleTiers);
        var basePrice = {{ $product->price }};
        var currency = "{{ $siteSetting->currency ?? '₹' }}";

        function updateTotalPrice() {
            var qty = parseInt($('#product_quantity').val()) || 1;
            var unitPrice = basePrice;

            // Check for wholesale price
            for (var i = wholesalePrices.length - 1; i >= 0; i--) {
                if (qty >= wholesalePrices[i].min) {
                    unitPrice = wholesalePrices[i].price;
                    break;
                }
            }

            var total = unitPrice * qty;
            $('#total_price_amount').text(currency + total.toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2}));
        }

        // Handle quantity changes (including from main.js buttons)
        $('#product_quantity').on('change keyup input', function() {
            updateTotalPrice();
        });

        $('.btn-plus, .btn-minus').on('click', function() {
            // Wait a tiny bit for main.js to update the value
            setTimeout(updateTotalPrice, 10);
        });

        $('#add_to_cart_link').on('click', function(e) {
            e.preventDefault();
            var quantity = $('#product_quantity').val();
            var baseUrl = $(this).attr('href');
            window.location.href = baseUrl + '?quantity=' + quantity;
        });

        // Copy Coupon Code logic for clickable cards
        $('.coupon-card-clickable').on('click', function() {
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
                    text: 'Coupon code ' + code + ' copied to clipboard.',
                    icon: 'success',
                    timer: 1500,
                    showConfirmButton: false,
                    toast: true,
                    position: 'top-end'
                });
            });
        });

        // Initialize display
        updateTotalPrice();
    });
</script>
<style>
    .coupon-card-clickable:hover {
        background-color: #f0fff4 !important;
        transform: translateY(-2px);
        box-shadow: 0 4px 6px rgba(0,0,0,0.05);
    }
</style>
@endsection
