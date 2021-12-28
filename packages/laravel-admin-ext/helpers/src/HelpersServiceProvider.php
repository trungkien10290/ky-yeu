<?php

namespace Encore\Admin\Helpers;

use Illuminate\Support\ServiceProvider;

class HelpersServiceProvider extends ServiceProvider
{
    /**
     * {@inheritdoc}
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'laravel-admin-helpers');
        if(app()->environment('local')){
            Helpers::boot();
        }
    }
}
