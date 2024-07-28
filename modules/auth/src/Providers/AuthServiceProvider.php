<?php

namespace Modules\Auth\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function register(): void
	{
        $this->app->register(AuthRouteServiceProvider::class);
	}

    /**
     * @return void
     */
    public function boot(): void
	{
	}
}
