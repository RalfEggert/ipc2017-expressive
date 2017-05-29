<?php
/**
 * IPC2017 Zend\Expressive Workshop
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/RalfEggert/ipc2017-expressive
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

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
use Zend\Expressive\Template\TemplateRendererInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * Class CustomerCreateFormFactory
 *
 * @package CustomerApp\Action
 */
class CustomerCreateFormFactory implements FactoryInterface
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

        $template     = $container->get(TemplateRendererInterface::class);
        $repository   = $container->get(CustomerRepositoryInterface::class);
        $customerForm = $formElementManager->get(CustomerForm::class);

        return new CustomerCreateFormAction($template, $repository, $customerForm);
    }

}