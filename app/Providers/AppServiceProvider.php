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
        if (App::runningInConsole()) {
            return;
        }

        $connection = config('database.default');
        if ($connection === 'sqlite') {
            $dbConnection = env('DB_CONNECTION');
            $dbDatabase = env('DB_DATABASE');

            if ($dbConnection !== 'sqlite') {
                $message = 'Database connection fallback terdeteksi. ';
                $message .= 'APP_ENV=' . env('APP_ENV') . ', ';
                $message .= 'DB_CONNECTION=' . ($dbConnection ?: 'null') . ', ';
                $message .= 'DB_DATABASE=' . ($dbDatabase ?: 'null') . '. ';
                $message .= 'File .env mungkin tidak terbaca. Hapus bootstrap/cache/config.php jika ada.';

                if ($this->app->hasDebugModeEnabled()) {
                    throw new \RuntimeException($message);
                }

                abort(500, $message);
            }
        }
    }
}
