<?php

namespace Jdecoster\RoutingExtraBundle\Routing\Util;

use Symfony\Component\Routing\Route;


class RoleManipulator
{
    static $defaultRoles = array("IS_AUTHENTICATED_ANONYMOUSLY");
    private $roleHierarchy;

    public function __construct( $roleHierarchy) {
        $this->roleHierarchy = $roleHierarchy;
    }

    /**
     * Getting all roles from the security role hierarchy
     * @return array
     */
    public function getAll()
    {
        $roles = self::$defaultRoles;
        foreach( $this->roleHierarchy as $parentRole => $childRoles ) {
            $roles = array_merge(
                $roles,
                array( $parentRole ),
                array_values( $childRoles )
            );
        }
        return array_unique( $roles );
    }

    public function prepareRouteConfig( Route $route )
    {
        $controller = null;
        $action = null;

        return array(
            "path"          => $route->getPath(),
            "controller"    => $controller,
            "action"        => $action
        );
    }
}
