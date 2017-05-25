<?php
/**
 * IPC2017 Zend\Expressive Workshop
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/RalfEggert/ipc2017-expressive
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace CustomerApp\Form;

use CustomerDomain\InputFilter\CustomerInputFilter;
use Interop\Container\ContainerInterface;
use Zend\InputFilter\InputFilterPluginManager;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * Class CustomerFormFactory
 *
 * @package CustomerApp\Form
 */
class CustomerFormFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string             $requestedName
     * @param array|null         $options
     *
     * @return CustomerForm
     */
    public function __invoke(
        ContainerInterface $container, $requestedName, array $options = null
    ) {
        /** @var InputFilterPluginManager $inputFilterManager */
        $inputFilterManager = $container->get('InputFilterManager');

        $customerInputFilter = $inputFilterManager->get(
            CustomerInputFilter::class
        );

        $customerForm = new CustomerForm;
        $customerForm->setInputFilter($customerInputFilter);

        return $customerForm;
    }
}
