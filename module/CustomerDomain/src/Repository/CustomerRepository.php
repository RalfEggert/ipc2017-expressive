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
    private $storage;

    /**
     * CustomerRepository constructor.
     *
     * @param CustomerStorageInterface $storage
     */
    public function __construct(CustomerStorageInterface $storage)
    {
        $this->storage = $storage;
    }

    /**
     * @return array
     */
    public function getCustomerList(): array
    {
        return $this->storage->fetchCustomerRows();
    }

    /**
     * @param int $id
     *
     * @return array
     */
    public function getCustomerById(int $id): array
    {
        return $this->storage->fetchSingleById($id);
    }

    /**
     * @param array $data
     *
     * @return bool
     */
    public function saveCustomer(array $data): bool
    {
        if (isset($data['save_customer'])) {
            unset($data['save_customer']);
        }

        if (isset($data['password']) && !empty($data['password'])) {
            $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
        } else {
            unset($data['password']);
        }

        if (!isset($data['id'])) {
            return $this->storage->createCustomer($data);
        } else {
            return $this->storage->updateCustomer($data['id'], $data);
        }
    }

    /**
     * @param int $id
     *
     * @return bool
     */
    public function removeCustomer(int $id): bool
    {
        return $this->storage->deleteCustomer($id);
    }
}
