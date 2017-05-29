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
use CustomerApp\Config\RouterDelegateFactory;
use Zend\Expressive\Application;

class ConfigProvider
{
    public function __invoke(): array
    {
        return [
            'dependencies' => [
                'factories'  => [
                    CustomerListAction::class   => CustomerListFactory::class,
                    CustomerShowAction::class   => CustomerShowFactory::class,
                    CustomerCreateAction::class => CustomerCreateFactory::class,
                ],
                'delegators' => [
                    Application::class => [
                        RouterDelegateFactory::class,
                    ],
                ],
            ],
            'templates'    => [
                'paths' => [
                    'customer-app' => [__DIR__ . '/../templates/customer-app'],
                ],
            ],
        ];
    }
}
