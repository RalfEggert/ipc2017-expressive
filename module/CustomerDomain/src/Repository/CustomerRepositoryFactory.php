<?php
/**
 * IPC2017 Zend\Expressive Workshop
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/RalfEggert/ipc2017-expressive
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace CustomerDomain\Repository;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * Class CustomerRepositoryFactory
 *
 * @package CustomerDomain\Repository
 */
class CustomerRepositoryFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string             $requestedName
     * @param array|null         $options
     *
     * @return CustomerRepository
     */
    public function __invoke(
        ContainerInterface $container, $requestedName, array $options = null
    ): CustomerRepository {
        $data = include __DIR__ . '/../../../../data/customer.php';

        $repository = new CustomerRepository($data);

        return $repository;
    }
}
