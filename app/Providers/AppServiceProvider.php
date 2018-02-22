<?php

namespace App\Providers;

use App\Services\BaiDuFanYiService;
use App\Services\UploadService;
use Illuminate\Support\ServiceProvider;
use Schema;
use App\Services\Linker;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     * @return void
     */
    public function boot(Linker $linker)
    {
        Schema::defaultStringLength(191);
        $this->setupLinker($linker);
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
        $this->app->singleton(BaiDuFanYiService::class, function ($app) {
            return new BaiDuFanYiService(
                env('BAIDU_FANYI_APP_ID'),
                env('BAIDU_FANYI_APP_KEY'),
                env('BAIDU_FANYI_URL')
            );
        });
    }

    /**
     * 配置Linker
     *
     * @param Linker $linker
     */
    protected function setupLinker(Linker $linker)
    {
        $resourceUrlPrefix = env('RESOURCE_URL_PREFIX');
        if ($resourceUrlPrefix == '') throw new \RuntimeException('请配置RESOURCE_URL_PREFIX');

        $linker->set('resource', $resourceUrlPrefix);
    }
}
