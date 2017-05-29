<?php
/**
 * IPC2017 Zend\Expressive Workshop
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/RalfEggert/ipc2017-expressive
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace App\Config;

use App\Action\HomePageAction;
use App\Action\PingAction;
use Interop\Container\ContainerInterface;
use Zend\Expressive\Application;
use Zend\ServiceManager\Factory\DelegatorFactoryInterface;

/**
 * Class RouterDelegateFactory
 *
 * @package App\Config
 */
class RouterDelegateFactory implements DelegatorFactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string             $name
     * @param callable           $callback
     * @param array|null         $options
     *
     * @return mixed
     */
    public function __invoke(
        ContainerInterface $container, $name, callable $callback,
        array $options = null
    ) {
        /** @var Application $app */
        $app = $callback();

        $app->get('/', HomePageAction::class, 'home');
        $app->get('/api/ping', PingAction::class, 'api.ping');

        return $app;
    }

}