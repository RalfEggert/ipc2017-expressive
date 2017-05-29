<?php
/**
 * IPC2017 Zend\Expressive Workshop
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/RalfEggert/ipc2017-expressive
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace CustomerApp;

use CustomerApp\Action\CustomerCreateFormAction;
use CustomerApp\Action\CustomerCreateFormFactory;
use CustomerApp\Action\CustomerListAction;
use CustomerApp\Action\CustomerListFactory;
use CustomerApp\Action\CustomerShowAction;
use CustomerApp\Action\CustomerShowFactory;
use CustomerApp\Action\CustomerUpdateFormAction;
use CustomerApp\Action\CustomerUpdateFormFactory;
use CustomerApp\Config\RouterDelegateFactory;
use CustomerApp\Form\CustomerForm;
use Zend\Expressive\Application;
use Zend\ServiceManager\Factory\InvokableFactory;

class ConfigProvider
{
    public function __invoke(): array
    {
        return [
            'dependencies'  => [
                'factories'  => [
                    CustomerListAction::class       => CustomerListFactory::class,
                    CustomerShowAction::class       => CustomerShowFactory::class,
                    CustomerCreateFormAction::class => CustomerCreateFormFactory::class,
                    CustomerUpdateFormAction::class => CustomerUpdateFormFactory::class,
                ],
                'delegators' => [
                    Application::class => [
                        RouterDelegateFactory::class,
                    ],
                ],
            ],
            'form_elements' => [
                'factories' => [
                    CustomerForm::class => InvokableFactory::class,
                ],
            ],
            'templates'     => [
                'paths' => [
                    'customer-app' => [__DIR__ . '/../templates/customer-app'],
                ],
            ],
        ];
    }
}
