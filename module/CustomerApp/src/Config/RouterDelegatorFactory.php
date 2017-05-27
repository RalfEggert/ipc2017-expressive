<?php
/**
 * IPC2017 Zend\Expressive Workshop
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/RalfEggert/ipc2017-expressive
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace CustomerApp\Config;

use CustomerApp\Action\CustomerCreateAction;
use CustomerApp\Action\CustomerListAction;
use CustomerApp\Action\CustomerShowAction;
use Interop\Container\ContainerInterface;
use Zend\Expressive\Application;
use Zend\ServiceManager\Factory\DelegatorFactoryInterface;

/**
 * Class RouterDelegatorFactory
 *
 * @package CustomerApp\Config
 */
class RouterDelegatorFactory implements DelegatorFactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string             $name
     * @param callable           $callback
     * @param array|null         $options
     *
     * @return Application
     */
    public function __invoke(
        ContainerInterface $container, $name, callable $callback,
        array $options = null
    ) {
        /** @var Application $app */
        $app = $callback();

        $app->get('/customer', CustomerListAction::class, 'customer-list');
        $app->get('/customer/:id', CustomerShowAction::class, 'customer-show')
            ->setOptions(['constraints' => ['id' => '[0-9]+']]);
        $app->get(
            '/customer/create', CustomerCreateAction::class, 'customer-create'
        );

        return $app;
    }
}