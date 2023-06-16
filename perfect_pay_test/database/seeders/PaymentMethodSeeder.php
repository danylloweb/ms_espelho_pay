<?php

namespace Database\Seeders;

use App\Entities\PaymentMethod;
use App\Entities\TransactionStatus;
use Illuminate\Database\Seeder;

class PaymentMethodSeeder extends Seeder
{
    public function run()
    {
        $transactionStatuses = [
            ['name' => 'BOLETO',     'qty_due_date' => 1],
            ['name' => 'PIX',        'qty_due_date' => 1],
            ['name' => 'CREDIT_CARD','qty_due_date' => 2],
        ];
        foreach ($transactionStatuses as $transactionStatus) {PaymentMethod::create($transactionStatus);}
    }
}
