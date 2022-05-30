<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Operator;
use App\Models\Transaction;

class AuthServiceProvider extends ServiceProvider {
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot() {
        $this->registerPolicies();

        Gate::define('is-owner', function (Operator $operator) {
            return $operator->role_id == 1;
        });
        Gate::define('manage-transaction', function (Operator $operator, Transaction $transaction) {
            return $operator->role_id == 1 || $operator->id == $transaction->operator_id;
        });
    }
}
