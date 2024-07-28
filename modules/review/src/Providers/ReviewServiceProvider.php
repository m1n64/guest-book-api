<?php

namespace Modules\Review\Providers;

use Illuminate\Support\ServiceProvider;

class ReviewServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function register(): void
	{
        $this->app->register(ReviewRouteServiceProvider::class);
	}

}
