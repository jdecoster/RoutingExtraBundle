<?php

namespace Jdecoster\RoutingExtraBundle\Routing\Util;

use Symfony\Bundle\FrameworkBundle\Controller\ControllerNameParser;
use Symfony\Component\Routing\Route;


class RoleManipulator
{
    static $defaultRoles = array("IS_AUTHENTICATED_ANONYMOUSLY");
    private $roleHierarchy;
    private $controllerNameParser;

    public function __construct( $roleHierarchy, ControllerNameParser $controllerNameParser) {
        $this->roleHierarchy = $roleHierarchy;
        $this->controllerNameParser = $controllerNameParser;
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
