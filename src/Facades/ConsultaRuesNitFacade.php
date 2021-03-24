<?php

namespace MiguelGarces\ConsultasRues\Facades;

use Illuminate\Support\Facades\Facade;

class ConsultaRuesNitFacade extends Facade {

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() { 
        return 'ConsultaRuesByNit'; 
    }


}