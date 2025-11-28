@extends('layouts.contentLayoutMaster')

@section('title', 'Subscribe to Tracklet')

@section('vendor-style')
<link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/sweetalert2.min.css')) }}">
@endsection

@section('content')
@include('panels.response')

<div class="row justify-content-center">
    <div class="col-12 col-md-10 col-lg-8">
        <!-- Welcome Header -->
        <div class="text-center mb-3">
            <h2 class="mb-1">Welcome to Tracklet!</h2>
            <p class="text-muted">Complete your subscription to get started with <strong>{{ $organization->name }}</strong></p>
        </div>

        <!-- Subscription Card -->
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-primary text-white text-center py-3">
                <h4 class="card-title mb-0 text-white">
                    <i data-feather="zap" class="mr-50"></i>
                    Annual Subscription Plan
                </h4>
            </div>
            <div class="card-body p-4">
                <!-- Trial Badge -->
                <div class="text-center mb-3">
                    <span class="badge badge-lg badge-light-success p-2 px-3">
                        <i data-feather="gift" class="mr-50" style="width: 16px; height: 16px;"></i>
                        <strong>1 Month Free Trial</strong>
                    </span>
                </div>

                <!-- Subscription Details -->
                <div class="row mb-3">
                    <div class="col-12">
                        <div class="d-flex justify-content-between align-items-center py-2 border-bottom">
                            <div class="d-flex align-items-center">
                                <i data-feather="check-circle" class="text-success mr-2" style="width: 20px; height: 20px;"></i>
                                <span class="font-weight-medium">Free Trial Period</span>
                            </div>
                            <span class="text-muted">30 Days</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center py-2 border-bottom">
                            <div class="d-flex align-items-center">
                                <i data-feather="check-circle" class="text-success mr-2" style="width: 20px; height: 20px;"></i>
                                <span class="font-weight-medium">Full Platform Access</span>
                            </div>
                            <span class="text-muted">All Features</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center py-2 border-bottom">
                            <div class="d-flex align-items-center">
                                <i data-feather="check-circle" class="text-success mr-2" style="width: 20px; height: 20px;"></i>
                                <span class="font-weight-medium">No Charges During Trial</span>
                            </div>
                            <span class="text-muted">$0.00</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center py-2 border-bottom">
                            <div class="d-flex align-items-center">
                                <i data-feather="check-circle" class="text-success mr-2" style="width: 20px; height: 20px;"></i>
                                <span class="font-weight-medium">Auto-Renewal</span>
                            </div>
                            <span class="text-muted">After Trial</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center py-2">
                            <div class="d-flex align-items-center">
                                <i data-feather="check-circle" class="text-success mr-2" style="width: 20px; height: 20px;"></i>
                                <span class="font-weight-medium">Cancel Anytime</span>
                            </div>
                            <span class="text-muted">No Penalties</span>
                        </div>
                    </div>
                </div>

                <!-- Info Alert -->
                <div class="alert alert-info border-left-3 border-left-info mb-3" role="alert">
                    <div class="d-flex align-items-start">
                        <i data-feather="info" class="mr-2 mt-1" style="width: 20px; height: 20px;"></i>
                        <div>
                            <h6 class="alert-heading mb-1">How It Works</h6>
                            <p class="mb-0 small">Start with a <strong>1-month free trial</strong> with full access to all Tracklet features. No charges during the trial period. After 30 days, your annual subscription will begin automatically. You can cancel anytime during the trial without any charges.</p>
                        </div>
                    </div>
                </div>

                <!-- What's Included -->
                <div class="card border border-primary mb-3">
                    <div class="card-header bg-light-primary py-2">
                        <h6 class="card-title mb-0">
                            <i data-feather="star" class="mr-50" style="width: 16px; height: 16px;"></i>
                            What's Included
                        </h6>
                    </div>
                    <div class="card-body py-2">
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <div class="d-flex align-items-center">
                                    <i data-feather="check" class="text-success mr-1" style="width: 16px; height: 16px;"></i>
                                    <span class="small">Multi-Organization Management</span>
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <div class="d-flex align-items-center">
                                    <i data-feather="check" class="text-success mr-1" style="width: 16px; height: 16px;"></i>
                                    <span class="small">Role-Based Access Control</span>
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <div class="d-flex align-items-center">
                                    <i data-feather="check" class="text-success mr-1" style="width: 16px; height: 16px;"></i>
                                    <span class="small">Expense Tracking Module</span>
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <div class="d-flex align-items-center">
                                    <i data-feather="check" class="text-success mr-1" style="width: 16px; height: 16px;"></i>
                                    <span class="small">Inventory Management</span>
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <div class="d-flex align-items-center">
                                    <i data-feather="check" class="text-success mr-1" style="width: 16px; height: 16px;"></i>
                                    <span class="small">Repair & Maintenance</span>
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <div class="d-flex align-items-center">
                                    <i data-feather="check" class="text-success mr-1" style="width: 16px; height: 16px;"></i>
                                    <span class="small">Asset Management</span>
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <div class="d-flex align-items-center">
                                    <i data-feather="check" class="text-success mr-1" style="width: 16px; height: 16px;"></i>
                                    <span class="small">Advanced Reporting</span>
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <div class="d-flex align-items-center">
                                    <i data-feather="check" class="text-success mr-1" style="width: 16px; height: 16px;"></i>
                                    <span class="small">Priority Support</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Security Note -->
                <div class="alert alert-light-success border-left-3 border-left-success mb-3" role="alert">
                    <div class="d-flex align-items-start">
                        <i data-feather="shield" class="mr-2 mt-1 text-success" style="width: 20px; height: 20px;"></i>
                        <div>
                            <h6 class="alert-heading mb-1 text-success">Secure Payment</h6>
                            <p class="mb-0 small">Your payment information is securely processed by Stripe. We never store your credit card details on our servers.</p>
                        </div>
                    </div>
                </div>

                <!-- Subscribe Button -->
                <form id="checkout-form" class="mt-4">
                    @csrf
                    <button type="submit" class="btn btn-primary btn-block btn-lg shadow" id="checkout-button">
                        <i data-feather="credit-card" class="mr-50"></i>
                        <span>Start Free Trial & Subscribe</span>
                    </button>
                    <p class="text-center text-muted small mt-2 mb-0">
                        By subscribing, you agree to our Terms of Service and Privacy Policy
                    </p>
                </form>
            </div>
        </div>

        <!-- Help Text -->
        <div class="text-center mt-3">
            <p class="text-muted small mb-0">
                <i data-feather="help-circle" class="mr-50" style="width: 14px; height: 14px;"></i>
                Need help? <a href="mailto:support@tracklet.com">Contact Support</a>
            </p>
        </div>
    </div>
</div>
@endsection

@section('vendor-script')
<script src="{{ asset(mix('vendors/js/extensions/sweetalert2.all.min.js')) }}"></script>
@endsection

@section('page-script')
<script>
$(document).ready(function() {
    // Initialize Feather Icons
    if (feather) {
        feather.replace({ width: 14, height: 14 });
    }

    $('#checkout-form').on('submit', function(e) {
        e.preventDefault();
        
        const button = $('#checkout-button');
        const originalText = button.html();
        button.prop('disabled', true).html('<span class="spinner-border spinner-border-sm mr-1"></span> Processing...');
        
        $.ajax({
            url: '{{ route("subscription.checkout.create") }}',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                if (response.success && response.data.checkout_url) {
                    window.location.href = response.data.checkout_url;
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: response.message || 'Failed to create checkout session',
                        confirmButtonText: 'Try Again'
                    });
                    button.prop('disabled', false).html(originalText);
                }
            },
            error: function(xhr) {
                const error = xhr.responseJSON?.message || 'An error occurred. Please try again.';
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: error,
                    confirmButtonText: 'OK'
                });
                button.prop('disabled', false).html(originalText);
            }
        });
    });
});
</script>
@endsection
