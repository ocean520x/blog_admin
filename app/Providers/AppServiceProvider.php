<?php

namespace App\Providers;

use App\Services\AliYunService;
use App\Services\CodeService;
use App\Services\UploadService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        if ($this->app->environment('local')) {
            $this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class);
            $this->app->register(TelescopeServiceProvider::class);
        }
        $this->app->instance(CodeService::class, new CodeService());
        $this->app->instance(AliYunService::class, new AliYunService());
        $this->app->instance(UploadService::class, new UploadService());
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
