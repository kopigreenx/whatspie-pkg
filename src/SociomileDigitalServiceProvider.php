<?php

namespace Kopigreenx\SociomileDigital;

use Illuminate\Support\ServiceProvider;


class SociomileDigitalServiceProvider extends ServiceProvider
{

 public function boot()
 {
    $this->loadMigrationsFrom(__DIR__.'/database/migrations');
 }

 public function register()
 {
    $this->app->singleton(SociomileDigital::class, function(){
        return SociomileDigital();
    });
 }

}
