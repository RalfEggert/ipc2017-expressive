<?php
/**
 * IPC2017 Zend\Expressive Workshop
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/RalfEggert/ipc2017-expressive
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace CustomerApp;

use CustomerApp\Action\CustomerListAction;
use CustomerApp\Action\CustomerListFactory;

class ConfigProvider
{
    public function __invoke(): array
    {
        return [
            'dependencies' => [
                'factories' => [
                    CustomerListAction::class => CustomerListFactory::class,
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
