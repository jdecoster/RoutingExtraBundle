<?php

namespace Jdecoster\RoutingExtraBundle\Routing\Builder\Reader;

use jdecoster\RoutingExtraBundle\Routing\Builder\Reader\ReaderInterface;
use jdecoster\RoutingExtraBundle\Routing\Util\RoleManipulator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\AccessMapInterface;

class AccessMapReader implements ReaderInterface
{
    private $accessMap;


    public function __construct( AccessMapInterface $accessMap )
    {
        $this->accessMap = $accessMap;
    }

    /**
     * Map the array output to a single array
     *
     * @param $routePath
     * @return array
     */
    public function read( array $attributes )
    {
        $roles = array();
        $securityRoles = $this->accessMap->getPatterns( Request::create( $attributes['path'] ));
        foreach( $securityRoles as $securitySubRoles ) {
            if( is_array( $securitySubRoles ) ) {
                foreach ( $securitySubRoles as $role ) {
                    if ( null !== $role ) {
                        array_push( $roles, $role );
                    }
                }
            }
        }
        return ( count($roles) > 0 ? array_unique( $roles ) : RoleManipulator::$defaultRoles );
    }
}