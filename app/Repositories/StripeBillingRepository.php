<?php

namespace App\Repositories;

use App\Contracts\BillingRepositoryInterface;
use Stripe\Stripe;
use Stripe\PaymentMethod;
use Stripe\Customer;
use App\Models\User;
use Illuminate\Support\Facades\Log;


class StripeBillingRepository implements BillingRepositoryInterface {

    public function __construct($stripeApiKey) {
        Stripe::setApiKey($stripeApiKey);
    }

    public function createStripeCustomer($data) {
        $user = User::create($data->except('_token'));
        $user->createAsStripeCustomer();
    }

    public function addStripePaymentMethod($customerId, $paymentMethodToken) {
        try {
            // Retrieve the customer from Stripe
            $customer = Customer::retrieve($customerId);

            // Attach the payment method to the customer
            $paymentMethod = PaymentMethod::retrieve($paymentMethodToken);
            $paymentMethod->attach(['customer' => $customer->id]);

            // Set the default payment method if needed
            $customer->invoice_settings->default_payment_method = $paymentMethod->id;
            $customer->save();

            // Handle success and return a response
            return [
                'success' => true,
                'message' => 'Payment method added successfully.',
            ];
        } catch (\Exception $e) {
            // Handle errors and return an error response
            Log::channel('stripeLog')->error('Something went wrong => : '.$e->getMessage());

            return [
                'success' => false,
                'message' => 'Something went wrong!',
            ];
        }
    }
}
