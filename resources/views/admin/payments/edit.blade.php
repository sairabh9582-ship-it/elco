@extends('layouts.admin')

@section('content')
<div class="container-fluid content-inner pb-0">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Edit {{ $payment->name }} Settings</h4>
                    </div>
                    <a href="{{ route('admin.payments.index') }}" class="btn btn-secondary">Back</a>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.payments.update', $payment) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-3 form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="status" name="status" value="1" {{ $payment->status ? 'checked' : '' }}>
                            <label class="form-check-label" for="status">Enable Gateway</label>
                        </div>
                        
                        {{-- Dynamic Settings Fields based on Code --}}
                        @if($payment->code == 'cod')
                            <p class="text-muted">No additional settings for Cash on Delivery.</p>
                        @elseif($payment->code == 'stripe')
                            <div class="mb-3">
                                <label class="form-label">Publishable Key</label>
                                <input type="text" class="form-control" name="settings[publishable_key]" value="{{ $payment->settings['publishable_key'] ?? '' }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Secret Key</label>
                                <input type="text" class="form-control" name="settings[secret_key]" value="{{ $payment->settings['secret_key'] ?? '' }}">
                            </div>
                        @elseif($payment->code == 'paypal')
                             <div class="mb-3">
                                <label class="form-label">Client ID</label>
                                <input type="text" class="form-control" name="settings[client_id]" value="{{ $payment->settings['client_id'] ?? '' }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Client Secret</label>
                                <input type="text" class="form-control" name="settings[client_secret]" value="{{ $payment->settings['client_secret'] ?? '' }}">
                            </div>
                        @elseif($payment->code == 'razorpay')
                             <div class="mb-3">
                                <label class="form-label">Key ID</label>
                                <input type="text" class="form-control" name="settings[key_id]" value="{{ $payment->settings['key_id'] ?? '' }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Key Secret</label>
                                <input type="text" class="form-control" name="settings[key_secret]" value="{{ $payment->settings['key_secret'] ?? '' }}">
                            </div>
                        @elseif($payment->code == 'phonepe')
                             <div class="mb-3">
                                <label class="form-label">Merchant ID</label>
                                <input type="text" class="form-control" name="settings[merchant_id]" value="{{ $payment->settings['merchant_id'] ?? '' }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Salt Key</label>
                                <input type="text" class="form-control" name="settings[salt_key]" value="{{ $payment->settings['salt_key'] ?? '' }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Salt Index</label>
                                <input type="text" class="form-control" name="settings[salt_index]" value="{{ $payment->settings['salt_index'] ?? '1' }}">
                            </div>
                            <div class="mb-3">
                               <label class="form-label">Environment</label>
                               <select class="form-control" name="settings[env]">
                                   <option value="sandbox" {{ ($payment->settings['env'] ?? '') == 'sandbox' ? 'selected' : '' }}>Sandbox</option>
                                   <option value="production" {{ ($payment->settings['env'] ?? '') == 'production' ? 'selected' : '' }}>Production</option>
                               </select>
                           </div>
                        @elseif($payment->code == 'paytm')
                             <div class="mb-3">
                                <label class="form-label">Merchant ID</label>
                                <input type="text" class="form-control" name="settings[merchant_id]" value="{{ $payment->settings['merchant_id'] ?? '' }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Merchant Key</label>
                                <input type="text" class="form-control" name="settings[merchant_key]" value="{{ $payment->settings['merchant_key'] ?? '' }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Website</label>
                                <input type="text" class="form-control" name="settings[website]" value="{{ $payment->settings['website'] ?? 'WEBSTAGING' }}">
                            </div>
                            <div class="mb-3">
                               <label class="form-label">Environment</label>
                               <select class="form-control" name="settings[env]">
                                   <option value="sandbox" {{ ($payment->settings['env'] ?? '') == 'sandbox' ? 'selected' : '' }}>Sandbox</option>
                                   <option value="production" {{ ($payment->settings['env'] ?? '') == 'production' ? 'selected' : '' }}>Production</option>
                               </select>
                           </div>
                        @endif

                        <button type="submit" class="btn btn-primary mt-3">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
