    <!-- Footer Start -->
    <div class="container-fluid footer py-3 wow fadeIn" data-wow-delay="0.2s">
        <div class="container py-3">
            <div class="row g-4 rounded mb-4" style="background: rgba(255, 255, 255, .03);">
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="rounded p-4">
                        <div class="rounded-circle bg-secondary d-flex align-items-center justify-content-center mb-3" style="width: 70px; height: 70px;">
                            <i class="fas fa-map-marker-alt fa-2x text-primary"></i>
                        </div>
                        <div>
                            <h4 class="text-white">Address</h4>
                            <p class="mb-2">{{ $siteSetting->address ?? '123 Street New York.USA' }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="rounded p-4">
                        <div class="rounded-circle bg-secondary d-flex align-items-center justify-content-center mb-3" style="width: 70px; height: 70px;">
                            <i class="fas fa-envelope fa-2x text-primary"></i>
                        </div>
                        <div>
                            <h4 class="text-white">Mail Us</h4>
                            <p class="mb-2">{{ $siteSetting->email ?? 'info@example.com' }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="rounded p-4">
                        <div class="rounded-circle bg-secondary d-flex align-items-center justify-content-center mb-3" style="width: 70px; height: 70px;">
                            <i class="fa fa-phone-alt fa-2x text-primary"></i>
                        </div>
                        <div>
                            <h4 class="text-white">Telephone</h4>
                            <p class="mb-2">{{ $siteSetting->footer_phone ?? '(+012) 3456 7890' }}</p>
                        </div>
                    </div>
                </div>
                 <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="rounded p-4">
                        <div class="rounded-circle bg-secondary d-flex align-items-center justify-content-center mb-3" style="width: 70px; height: 70px;">
                            <i class="fa fa-share-alt fa-2x text-primary"></i>
                        </div>
                        <div class="d-flex flex-column">
                            <h4 class="text-white mb-3">Follow Us</h4>
                            <div class="d-flex">
                                @if($siteSetting->twitter_link)
                                    <a class="btn btn-secondary btn-md-square rounded-circle me-2" href="{{ $siteSetting->twitter_link }}"><i class="fab fa-twitter"></i></a>
                                @endif
                                @if($siteSetting->facebook_link)
                                    <a class="btn btn-secondary btn-md-square rounded-circle me-2" href="{{ $siteSetting->facebook_link }}"><i class="fab fa-facebook-f"></i></a>
                                @endif
                                @if($siteSetting->youtube_link)
                                    <a class="btn btn-secondary btn-md-square rounded-circle me-2" href="{{ $siteSetting->youtube_link }}"><i class="fab fa-youtube"></i></a>
                                @endif
                                @if($siteSetting->linkedin_link)
                                    <a class="btn btn-secondary btn-md-square rounded-circle me-2" href="{{ $siteSetting->linkedin_link }}"><i class="fab fa-linkedin-in"></i></a>
                                @endif
                                @if($siteSetting->whatsapp_link)
                                    <a class="btn btn-secondary btn-md-square rounded-circle me-2" href="{{ $siteSetting->whatsapp_link }}"><i class="fab fa-whatsapp"></i></a>
                                @endif
                                @if($siteSetting->instagram_link)
                                    <a class="btn btn-secondary btn-md-square rounded-circle" href="{{ $siteSetting->instagram_link }}"><i class="fab fa-instagram"></i></a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <div class="footer-item">
                        <h4 class="text-light mb-3">Why People Like us!</h4>
                        <p class="mb-3">{{ $siteSetting->footer_description ?? 'Typesetting, remaining essentially unchanged. It was popularised in the 1960s with the like Aldus PageMaker including of Lorem Ipsum.' }}</p>
                        <a href="" class="btn border-secondary py-2 px-4 rounded-pill text-primary">Read More</a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="d-flex flex-column text-start footer-item">
                        <h4 class="text-light mb-3">Our Menu</h4>
                         @if(isset($footerMenus))
                            @foreach($footerMenus as $menu)
                                <a class="btn-link" href="{{ $menu->url }}">{{ $menu->title }}</a>
                            @endforeach
                        @else
                            <a class="btn-link" href="">About Us</a>
                            <a class="btn-link" href="">Contact Us</a>
                            <a class="btn-link" href="">Privacy Policy</a>
                            <a class="btn-link" href="">Terms & Condition</a>
                            <a class="btn-link" href="">Return Policy</a>
                            <a class="btn-link" href="">FAQs & Help</a>
                        @endif
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="d-flex flex-column text-start footer-item">
                        <h4 class="text-light mb-3">Account</h4>
                        <a class="btn-link" href="{{ route('profile.edit') }}">My Account</a>
                        <a class="btn-link" href="{{ route('cart') }}">Shopping Cart</a>
                        <a class="btn-link" href="{{ route('orders.index') }}">Order History</a>
                        <a class="btn-link" href="{{ route('wishlist.index') }}">Wishlist</a>
                        <a class="btn-link" href="{{ route('compare.index') }}">Compare</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->

    <!-- Copyright Start -->
    <div class="container-fluid copyright py-2">
        <div class="container">
            <div class="row g-4 align-items-center">
                <div class="col-md-6 text-center text-md-start mb-md-0">
                    <span class="text-white"><a href="#" class="border-bottom text-white"><i class="fas fa-copyright text-light me-2"></i>{{ $siteSetting->copyright_text ?? 'Your Site Name' }}</a></span>
                </div>
                <div class="col-md-6 text-center text-md-end text-white">
                    Designed By <a class="border-bottom text-white" href="/">Reef Technologies</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Copyright End -->
