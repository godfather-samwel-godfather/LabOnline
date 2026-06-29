<?php

interface MobileMoneyService
{
    /**
     * Process payment.
     *
     * @param array $payment Payment information
     * @return array Response from provider
     */
    public function pay(array $payment): array;
}