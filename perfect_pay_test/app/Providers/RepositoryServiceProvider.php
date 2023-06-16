<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(\App\Repositories\UserRepository::class, \App\Repositories\UserRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\UserTypeRepository::class, \App\Repositories\UserTypeRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\TransactionRepository::class, \App\Repositories\TransactionRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\TransactionStatusRepository::class, \App\Repositories\TransactionStatusRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\CustomerRepository::class, \App\Repositories\CustomerRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\PaymentMethodRepository::class, \App\Repositories\PaymentMethodRepositoryEloquent::class);
        //:end-bindings:
    }
}
