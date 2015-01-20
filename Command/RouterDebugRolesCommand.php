<?php

namespace jdecoster\RoutingExtraBundle\Command;;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Helper\TableHelper;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Routing\RouterInterface;

/**
 * A console command for retrieving information about routes.
 *
 * @author Jan De Coster <jan@we-create.be>
 */
class RouterDebugRolesCommand extends ContainerAwareCommand
{
    /**
     * {@inheritdoc}
     */
    public function isEnabled()
    {
        if (!$this->getContainer()->has('router')) {
            return false;
        }
        $router = $this->getContainer()->get('router');
        if (!$router instanceof RouterInterface) {
            return false;
        }
        return parent::isEnabled();
    }

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('debug:router:roles')
            ->setAliases(array(
                'router:debug:roles',
            ))
            ->setDefinition(array(
            ))
            ->setDescription('Displays current routes for an application with the roles')
            ->setHelp(<<<EOF
The <info>%command.name%</info> displays the configured routes:

  <info>php %command.full_name%</info>

EOF
            );
    }
    /**
     * {@inheritdoc}
     *
     * @throws \InvalidArgumentException When route does not exist
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $routeRoleHelper = $this->getContainer()->get('jdecoster.routing_extra.route.role');
        $routes = $this->getContainer()->get('router')->getRouteCollection();

        $table = $this->getHelper('table');
	$table->setLayout(TableHelper::LAYOUT_COMPACT);
        $table->setHeaders(  array('Name','Method','Scheme','Host','Path', 'Roles'));
        $tableData = array();

        foreach($routes as $routeName => $route) {
            $row = array(
                $routeName,
                ( 0 == count($route->getMethods()) ? 'Any' : implode(', ', $route->getMethods() ) ),
                ( 0 == count($route->getSchemes()) ? 'Any' :implode(', ', $route->getSchemes() ) ),
                ( '' === $route->getHost() ? 'Any' : $route->getHost() ),
                $route->getPath(),

                implode( ', ', $routeRoleHelper->getRoles( $route ) ),
            );
            array_push($tableData, $row);
        }

        $table->setRows( $tableData );
        $table->render( $output );
    }
}
