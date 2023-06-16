<?php

namespace Database\Seeders;

use App\Entities\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'name'     => 'Danyllo',
                'email'    => 'danyllophp@gmail.com',
                'cpf_cnpj' => '08612634482',
                'user_type_id' => 1,
                'customer_id' => 1,
                'password' => bcrypt('elo1234*')
            ],
            [
                'name'     => 'Max',
                'email'    => 'max@gmail.com',
                'cpf_cnpj'     => '05357273308',
                'user_type_id' => 1,
                'customer_id' => 2,
                'password' => bcrypt('clif@0'),
            ],

        ];
        foreach ($users as $user) {User::create($user);}

        DB::table('oauth_clients')
            ->where('id',2)
            ->update(['secret' => "WgyQSFQnT6ywKXQOo2QRL0tJVIGeVHzBo9lnuu5X"]);
    }
}
