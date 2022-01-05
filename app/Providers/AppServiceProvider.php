<?php

namespace App\Providers;

use Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider;
use Encore\Admin\Helpers\HelpersServiceProvider;
use Encore\Admin\LogViewer\LogViewerServiceProvider;
use Encore\TMEditor\TMEditorServiceProvider;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->register(LogViewerServiceProvider::class);
        if (app()->environment('local')) {
            $this->app->register(HelpersServiceProvider::class);
            $this->app->register(IdeHelperServiceProvider::class);
        }

        //
    }
}
