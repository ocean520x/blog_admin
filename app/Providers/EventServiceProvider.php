<?php

namespace App\Providers;

use App\Models\Topic;
use App\Observers\TopicObserver;
use Illuminate\Support\ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // 注册观察者
        Topic::observe(TopicObserver::class);
    }
}
