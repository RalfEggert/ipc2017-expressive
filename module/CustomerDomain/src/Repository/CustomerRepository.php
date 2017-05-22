<?php
/**
 * IPC2017 Zend\Expressive Workshop
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/RalfEggert/ipc2017-expressive
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace CustomerDomain\Repository;

use CustomerDomain\Storage\CustomerStorageInterface;
use DomainException;

/**
 * Class CustomerRepository
 *
 * @package CustomerDomain\Repository
 */
class CustomerRepository implements CustomerRepositoryInterface
{
    /**
     * @var CustomerStorageInterface
     */
    private $customerStorage;

    /**
     * CustomerRepository constructor.
     *
     * @param CustomerStorageInterface $customerStorage
     */
    public function __construct(CustomerStorageInterface $customerStorage)
    {
        $this->customerStorage = $customerStorage;
    }

    /**
     * @return array
     * @throws DomainException
     */
    public function getCustomerList(): array
    {
        return $this->customerStorage->fetchCustomerList();
    }

    /**
     * @param int $id
     *
     * @return array
     * @throws DomainException
     */
    public function getCustomerById(int $id): array
    {
        return $this->customerStorage->fetchCustomerById($id);
    }
}
