<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Blog;
use App\Models\Item;
use App\Models\Sale;
use App\Models\User;
use App\Models\Debtor;
use App\Models\Depositor;
use App\Policies\ItemPolicy;
use App\Policies\DepositorPolicy;
//use App\Policies\RolePolicy;
use App\Policies\RolePolicy;
use App\Policies\SalePolicy;
use App\Policies\BlogPolicy;
use App\Policies\UserPolicy;
use App\Policies\DebtorPolicy;
use App\Policies\PermissionPolicy;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Permission::class=>PermissionPolicy::class,
        Role::class=>RolePolicy::class,
        User::class=>UserPolicy::class,
        Sale::class=>SalePolicy::class,
        Debtor::class=>DebtorPolicy::class,
        Item::class=>ItemPolicy::class,
        Blog::class=>BlogPolicy::class,
        Depositor::class=>DepositorPolicy::class,



    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}