<?php

namespace Jdecoster\RoutingExtraBundle\Routing\Builder\Reader;

interface ReaderInterface
{
    /**
     * Read the configuration and returns a array with the required roles
     *
     * @param array $attributes
     * @return mixed
     */
    public function read( array $attributes );
}
