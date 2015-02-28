<?php

namespace Jdecoster\RoutingExtraBundle\Routing;

use jdecoster\RoutingExtraBundle\Routing\Builder\RouteRoleBuilder;
use jdecoster\RoutingExtraBundle\Routing\Util\RoleManipulator;
use Symfony\Component\Routing\Route;

class Role
{
    private $routeRoleBuilder;
    private $roleManipulator;

    public function __construct(RouteRoleBuilder $routeRoleBuilder, RoleManipulator $roleManipulator)
    {
        $this->routeRoleBuilder = $routeRoleBuilder;
        $this->roleManipulator = $roleManipulator;
    }

    /**
     * Getting all the roles for a given string
     *
     * @param Route $config
     * @return string
     */
    public function getRoles(Route $route)
    {
        $config = $this->roleManipulator->prepareRouteConfig( $route );
        return $this->routeRoleBuilder->roleBuilder( $config );
    }
}