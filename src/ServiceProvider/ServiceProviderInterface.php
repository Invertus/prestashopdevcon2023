<?php

namespace Invertus\Prestashopdevcon\ServiceProvider;

interface ServiceProviderInterface
{
    /**
     * Gets service that is defined by module container.
     *
     * @param string $serviceName
     */
    public function getService($serviceName);
}