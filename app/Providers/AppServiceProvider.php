<?php

namespace App\Providers;

use Encore\Admin\Helpers\HelpersServiceProvider;
use Encore\Admin\LogViewer\LogViewer;
use Encore\Admin\LogViewer\LogViewerServiceProvider;
use Encore\Admin\Media\MediaServiceProvider;
use Encore\TMEditor\TMEditorServiceProvider;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

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
//        $this->app->register(TMEditorServiceProvider::class);
        if (app()->environment('local')) {
            $this->app->register(HelpersServiceProvider::class);
            $this->app->register(MediaServiceProvider::class);
            $this->app->register(LogViewerServiceProvider::class);
        }

        //
    }
}