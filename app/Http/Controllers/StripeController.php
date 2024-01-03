<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contracts\BillingRepositoryInterface;

class StripeController extends Controller
{
    protected $billingRepository;

    public function __construct(BillingRepositoryInterface $billingRepository) {
        $this->billingRepository = $billingRepository;
    }

    public function createCustomer(Request $request) {
        // Note: Data may come from various sources, not necessarily from a form.
        $this->billingRepository->createStripeCustomer($request->all());
        // Additional logic
    }

    public function addPaymentMethod(Request $request) {

        $request->validate([
            'customer_id' => 'required',
            'payment_method_token' => 'required',
        ]);

        $customerId = $request->input('customer_id'); // Get customer ID from request or elsewhere
        $paymentMethodToken = $request->input('payment_method_token'); // Get payment method token from request or elsewhere

        // Use the billingRepository to add the payment method
        $result = $this->billingRepository->addStripePaymentMethod($customerId, $paymentMethodToken);

        // Check the result and return a response
        if ($result['success']) {
            return redirect()->back()->with('success', $result['message']);
        } else {
            return redirect()->back()->with('error', $result['message']);
        }
    }
}
