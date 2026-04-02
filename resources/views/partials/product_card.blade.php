<div class="{{ $columnClass ?? 'col-md-6 col-lg-4 col-xl-3' }}">
    <div class="product-item rounded" data-wow-delay="0.1s">
        <div class="product-item-inner border rounded">
            <div class="product-item-inner-item">
                <img src="{{ asset($product->image) }}" class="img-fluid w-100 rounded-top" alt="">

                <div class="product-item-add text-center p-4">
                    <div class="product-item-add-inner">
                        <a href="{{ route('add.to.cart', $product->id) }}" class="btn btn-primary border-secondary rounded-pill py-2 px-4 mb-3"><i class="fas fa-shopping-cart me-2"></i> Add To Cart</a>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex">
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star"></i>
                            </div>
                            <div class="d-flex">
                                <a href="{{ route('product.detail', $product) }}" class="text-white d-flex align-items-center justify-content-center me-3" title="View Details"><span class="rounded-circle btn-sm-square border"><i class="fa fa-eye"></i></span></a>
                                <a href="{{ route('compare.add', $product->id) }}" class="text-white d-flex align-items-center justify-content-center me-3" title="Compare"><span class="rounded-circle btn-sm-square border"><i class="fas fa-random"></i></span></a>
                                <a href="{{ route('wishlist.add', $product->id) }}" class="text-white d-flex align-items-center justify-content-center me-0" title="Add to Wishlist"><span class="rounded-circle btn-sm-square border"><i class="fas fa-heart"></i></span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center rounded-bottom p-4">
                <a href="{{ route('product.detail', $product) }}" class="d-block mb-2">{{ $product->name }}</a>
                <a href="{{ route('product.detail', $product) }}" class="d-block h4">{{ $product->name }}</a>
                @if($product->old_price)
                    <del class="me-2 fs-5 text-muted">{{ $siteSetting->currency ?? '₹' }}{{ number_format($product->old_price, 2) }}</del>
                @endif
                <span class="text-primary fs-5 fw-bold">{{ $siteSetting->currency ?? '₹' }}{{ number_format($product->price, 2) }}</span>
                @if($product->isWholesaleProduct())
                    <div class="mt-2">
                        <span class="badge bg-success px-2 py-1" style="font-size: 0.7rem;">Wholesale Available</span>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
