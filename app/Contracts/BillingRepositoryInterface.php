<?php

namespace App\Contracts;

interface BillingRepositoryInterface {
    public function createStripeCustomer($data);
    public function addStripePaymentMethod($customerId, $paymentMethodTo);
}
