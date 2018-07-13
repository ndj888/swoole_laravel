<?php

namespace App\Providers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //开发环境加载
        if ($this->app->environment() !== 'production') {
            //ide-help
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
            //mode maker
            $this->app->register(\Reliese\Coders\CodersServiceProvider::class);
        }

        // 自动切换swoole 环境和 php-fpm
        if (App::runningInConsole()) {
            $this->app->register(\Hhxsv5\LaravelS\Illuminate\Database\DatabaseServiceProvider::class);
        } else {
            // 注册php-fpm database
            $this->app->register(\Illuminate\Database\DatabaseServiceProvider::class);
        }
    }
}
