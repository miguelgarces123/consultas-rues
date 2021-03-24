<?php
 
namespace MiguelGarces\ConsultasRues;
 
use Illuminate\Support\ServiceProvider;

use MiguelGarces\ConsultasRues\Consultas\ConsultaRuesByNit;
use MiguelGarces\ConsultasRues\Consultas\ConsultaRuesByNombre;
 
class RuesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('ConsultaRuesByNombre', function () {
            return new ConsultaRuesByNombre();
        });
        $this->app->bind('ConsultaRuesByNit', function () {
            return new ConsultaRuesByNit();
        });
    }
 
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
 
    }
 
}