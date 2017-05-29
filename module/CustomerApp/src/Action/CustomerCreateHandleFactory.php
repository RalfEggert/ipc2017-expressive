<?php
/**
 * IPC2017 Zend\Expressive Workshop
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/RalfEggert/ipc2017-expressive
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace CustomerApp\Action;

use CustomerApp\Form\CustomerForm;
use CustomerDomain\Repository\CustomerRepositoryInterface;
use Interop\Container\ContainerInterface;
use Zend\Expressive\Router\RouterInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * Class CustomerCreateHandleFactory
 *
 * @package CustomerApp\Action
 */
class CustomerCreateHandleFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string             $requestedName
     * @param array|null         $options
     *
     * @return mixed
     */
    public function __invoke(
        ContainerInterface $container, $requestedName, array $options = null
    ) {
        $formElementManager = $container->get('FormElementManager');

        $repository   = $container->get(CustomerRepositoryInterface::class);
        $customerForm = $formElementManager->get(CustomerForm::class);
        $router       = $container->get(RouterInterface::class);

        return new CustomerCreateHandleAction(
            $repository, $customerForm, $router
        );
    }

}