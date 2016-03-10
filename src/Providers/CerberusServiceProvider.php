<?php

declare (strict_types = 1);

namespace Cerberus\Providers;

use Cerberus\Acl as Cerberus;
use Silex\Application;
use Silex\ServiceProviderInterface;

class CerberusServiceProvider implements ServiceProviderInterface
{
    /**
     * @param Silex\Application $app
     */
    public function register(Application $app)
    {
        $app['cerberus'] = $app->share(function ($app) {
            return new Cerberus();
        });
    }

    /**
     * @param Silex\Application $app
     */
    public function boot(Application $app)
    {
        //
    }
}
