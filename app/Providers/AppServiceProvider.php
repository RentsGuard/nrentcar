<?php

namespace App\Providers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            return;
        }

        if ($this->app->configurationIsCached()) {
            return;
        }

        if (config('database.default') === 'sqlite') {
            throw new \RuntimeException(
                'Database default is SQLite. File .env mungkin tidak terbaca.'
            );
        }
    }
}
