<?php

namespace jdecoster\RoutingExtraBundle\Routing\Builder;

use jdecoster\RoutingExtraBundle\Routing\Builder\Reader\AccessMapReader;
use jdecoster\RoutingExtraBundle\Routing\Util\RoleManipulator;

class RouteRoleBuilder
{
    private $roleManipulator;
    private $accessMapReader;

    /**
     * Construction function
     *
     * @param RoleManipulator $roleManipulator
     */
    public function __construct(RoleManipulator $roleManipulator, AccessMapReader $accessMapReader)
    {
        $this->roleManipulator = $roleManipulator;
        $this->accessMapReader = $accessMapReader;
    }

    /**
     * Build the roles for a given route
     *
     * @param array $requiredRole
     * @return array
     */
    public function roleBuilder( array $config )
    {
        $systemRoles = $this->roleManipulator->getAll();
        $routeRoles = array();
        $requiredRoles = $this->accessMapReader->read( $config );
        $roleReached = false;
        foreach ($systemRoles as $role) {
            if ( in_array($role, $requiredRoles) || true === $roleReached ) {
                $routeRoles[] = $role;
                $roleReached = true;
            }
        }
        return array_unique($routeRoles);
    }

}