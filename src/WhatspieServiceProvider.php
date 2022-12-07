<?php

namespace Kopigreenx\Whatspie;

use Illuminate\Support\ServiceProvider;


class WhatspieServiceProvider extends ServiceProvider
{

 public function boot()
 {
    // $this->loadMigrationsFrom(__DIR__.'/database/migrations');
 }

 public function register()
 {
    $this->app->singleton(Whatspie::class, function(){
        return Whatspie();
    });
 }

}
