<?php

namespace Database\Seeders;

use App\Entities\TransactionStatus;
use Illuminate\Database\Seeder;

class TransactionStatusSeeder extends Seeder
{
    public function run()
    {
        $transactionStatuses = [
            ['name' => 'Criada'],
            ['name' => 'pendente'],
            ['name' => 'Cancelada'],
            ['name' => 'Paga'],
        ];
        foreach ($transactionStatuses as $transactionStatus) {TransactionStatus::create($transactionStatus);}
    }
}
