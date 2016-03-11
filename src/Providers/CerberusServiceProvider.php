<?php

declare (strict_types = 1);

namespace Cerberus\Providers;

class CerberusServiceProvider implements Silex\ServiceProviderInterface
{
    /**
     * @param Silex\Application $app
     */
    public function register(Silex\Application $app)
    {
        $app['cerberus'] = $app->share(function ($app) {
            return new Cerberus\Acl();
        });
    }

    /**
     * @param Silex\Application $app
     */
    public function boot(Silex\Application $app)
    {
        //
    }
}
