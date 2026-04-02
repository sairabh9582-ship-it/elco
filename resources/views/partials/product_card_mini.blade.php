<div class="products-mini-item border">
    <div class="row g-0">
        <div class="col-5">
            <div class="products-mini-img border-end h-100">
                <img src="{{ asset($product->image) }}" class="img-fluid w-100 h-100" alt="Image">
                <div class="products-mini-icon rounded-circle bg-primary">
                    <a href="{{ route('product.detail', $product) }}"><i class="fa fa-eye fa-1x text-white"></i></a>
                </div>
            </div>
        </div>
        <div class="col-7">
            <div class="products-mini-content p-3">
                <a href="{{ route('product.detail', $product) }}" class="d-block mb-2">{{ $product->category->name ?? 'Category' }}</a>
                <a href="{{ route('product.detail', $product) }}" class="d-block h4">{{ $product->name }}</a>
                @if($product->old_price)
                <del class="me-2 fs-5">Rs {{ number_format($product->old_price, 2) }}</del>
                @endif
                <span class="text-primary fs-5">Rs {{ number_format($product->price, 2) }}</span>
            </div>
        </div>
    </div>
    <div class="products-mini-add border p-3">
        <a href="{{ route('add.to.cart', $product->id) }}" class="btn btn-primary border-secondary rounded-pill py-2 px-4"><i class="fas fa-shopping-cart me-2"></i> Add To Cart</a>
        <div class="d-flex">
            <a href="#" class="text-primary d-flex align-items-center justify-content-center me-3"><span class="rounded-circle btn-sm-square border"><i class="fas fa-random"></i></i></a>
            <a href="#" class="text-primary d-flex align-items-center justify-content-center me-0"><span class="rounded-circle btn-sm-square border"><i class="fas fa-heart"></i></a>
        </div>
    </div>
</div>
