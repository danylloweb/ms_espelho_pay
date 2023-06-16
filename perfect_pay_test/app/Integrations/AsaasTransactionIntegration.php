<?php

namespace App\Integrations;

use Psr\Http\Message\StreamInterface;

/**
 * AsaasTransactionIntegration
 */
class AsaasTransactionIntegration extends AsaasIntegration
{

    /**
     * @param $data_payment
     * @return array|StreamInterface
     */
    public function paymentCreate($data_payment): array|StreamInterface
    {
        $action = 'payment_create';
        return $this->processRequest($action, $data_payment);
    }

    /**
     * @param $data_customer
     * @return array|StreamInterface
     */
    public function customerCreate($data_customer): array|StreamInterface
    {
        $action = 'customer_create';
        return $this->processRequest($action, $data_customer);
    }

}
