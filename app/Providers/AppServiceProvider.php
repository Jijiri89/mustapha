<?php

namespace App\Providers;
use App\Filament\MyLogoutResponse;
use Filament\Http\Responses\Auth\Contracts\LogoutResponse as LogoutResponseContract;

use App\Models\Item;
use App\Observers\ItemObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        $this->app->bind(LogoutResponseContract::class, MyLogoutResponse::class);

        //Item::observe(ItemObserver::class);
    }
}
