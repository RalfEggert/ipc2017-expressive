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
use Zend\Form\FormElementManager\FormElementManagerV3Polyfill;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * Class CustomerUpdateHandleFactory
 *
 * @package CustomerApp\Action
 */
class CustomerUpdateHandleFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string             $requestedName
     * @param array|null         $options
     *
     * @return CustomerUpdateHandleAction
     */
    public function __invoke(
        ContainerInterface $container, $requestedName, array $options = null
    ) {
        /** @var FormElementManagerV3Polyfill $formElementManager */
        $formElementManager = $container->get('FormElementManager');

        $repository = $container->get(CustomerRepositoryInterface::class);
        $router     = $container->get(RouterInterface::class);

        /** @var CustomerForm $customerForm */
        $customerForm = $formElementManager->get(CustomerForm::class);

        return new CustomerUpdateHandleAction(
            $repository, $router, $customerForm
        );
    }
}
