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

    /**
     * @param $data
     *
     * @return bool
     */
    public function saveCustomer($data): bool
    {
        if (isset($data['save_customer'])) {
            unset ($data['save_customer']);
        }

        $data['date'] = date('Y-m-d H:i:s');

        if (isset($data['password'])) {
            if (!empty($data['password'])) {
                $data['password'] = password_hash(
                    $data['password'], PASSWORD_BCRYPT
                );
            } else {
                unset($data['password']);
            }
        }

        if (isset($data['id']) && $this->getCustomerById($data['id'])) {
            return $this->customerStorage->updateCustomer($data['id'], $data);
        } else {
            return $this->customerStorage->createCustomer($data);
        }
    }

    /**
     * @param $data
     *
     * @return bool
     */
    public function deleteCustomer($data): bool
    {
        return $this->customerStorage->deleteCustomer($data['id']);
    }
}
