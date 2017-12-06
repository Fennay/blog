<?php

namespace App\Providers;

use App\Services\UploadService;
use Illuminate\Support\ServiceProvider;
use Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
    }

    /**
     * Register any application services.
     * @return void
     */
    public function register()
    {
        $this->app->singleton(UploadService::class, function ($app) {
            return new UploadService(
                $app->request,
                env('RESOURCE_RELATIVE_PATH'),
                env('TMP_UPLOAD_RELATIVE_PATH'),
                env('SAVED_UPLOAD_RELATIVE_PATH')
            );
        });
    }
}
