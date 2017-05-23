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
use CustomerApp\Action\CustomerCreateHandleAction;
use CustomerApp\Action\CustomerCreateHandleFactory;
use CustomerApp\Action\CustomerDeleteHandleAction;
use CustomerApp\Action\CustomerDeleteHandleFactory;
use CustomerApp\Action\CustomerListAction;
use CustomerApp\Action\CustomerListFactory;
use CustomerApp\Action\CustomerShowAction;
use CustomerApp\Action\CustomerShowFactory;
use CustomerApp\Action\CustomerUpdateFormAction;
use CustomerApp\Action\CustomerUpdateFormFactory;
use CustomerApp\Action\CustomerUpdateHandleAction;
use CustomerApp\Action\CustomerUpdateHandleFactory;
use CustomerApp\Config\RouterDelegatorFactory;
use CustomerApp\Form\CustomerForm;
use Zend\Expressive\Application;
use Zend\ServiceManager\Factory\InvokableFactory;

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
            'dependencies'  => $this->getDependencies(),
            'form_elements' => $this->getFormElements(),
            'templates'     => $this->getTemplates(),
        ];
    }

    /**
     * @return array
     */
    public function getDependencies(): array
    {
        return [
            'factories'  => [
                CustomerListAction::class         => CustomerListFactory::class,
                CustomerShowAction::class         => CustomerShowFactory::class,
                CustomerCreateFormAction::class   => CustomerCreateFormFactory::class,
                CustomerCreateHandleAction::class => CustomerCreateHandleFactory::class,
                CustomerUpdateFormAction::class   => CustomerUpdateFormFactory::class,
                CustomerUpdateHandleAction::class => CustomerUpdateHandleFactory::class,
                CustomerDeleteHandleAction::class => CustomerDeleteHandleFactory::class,
            ],
            'delegators' => [
                Application::class => [RouterDelegatorFactory::class],
            ],
        ];
    }

    /**
     * @return array
     */
    public function getFormElements(): array
    {
        return [
            'factories' => [
                CustomerForm::class => InvokableFactory::class,
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
