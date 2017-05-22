<?php
/**
 * IPC2017 Zend\Expressive Workshop
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/RalfEggert/ipc2017-expressive
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace CustomerApp;

use CustomerApp\Action\CustomerCreateAction;
use CustomerApp\Action\CustomerCreateFactory;
use CustomerApp\Action\CustomerListAction;
use CustomerApp\Action\CustomerListFactory;
use CustomerApp\Action\CustomerShowAction;
use CustomerApp\Action\CustomerShowFactory;
use CustomerApp\Config\RouterDelegatorFactory;
use Zend\Expressive\Application;

/**
 * Class ConfigProvider
 *
 * @package CustomerApp
 */
class ConfigProvider
{
    /**
     * @return array
     */
    public function __invoke(): array
    {
        return [
            'dependencies' => $this->getDependencies(),
            'templates'    => $this->getTemplates(),
        ];
    }

    /**
     * @return array
     */
    public function getDependencies(): array
    {
        return [
            'factories'  => [
                CustomerListAction::class   => CustomerListFactory::class,
                CustomerShowAction::class   => CustomerShowFactory::class,
                CustomerCreateAction::class => CustomerCreateFactory::class,
            ],
            'delegators' => [
                Application::class => [RouterDelegatorFactory::class],
            ],
        ];
    }

    /**
     * @return array
     */
    public function getTemplates(): array
    {
        return [
            'paths' => [
                'customer' => [__DIR__ . '/../templates/customer'],
            ],
        ];
    }
}
