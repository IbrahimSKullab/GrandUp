<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Algolia\AlgoliaSearch\SearchClient;

class AlgoliaServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(SearchClient::class, function () {
            return SearchClient::create(
                'YOUR_APP_ID',
                'YOUR_API_KEY'
            );
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
