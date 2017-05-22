<?php
/**
 * IPC2017 Zend\Expressive Workshop
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/RalfEggert/ipc2017-expressive
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace CustomerDomain\Storage;

/**
 * Interface CustomerStorageInterface
 *
 * @package CustomerDomain\Storage
 */
interface CustomerStorageInterface
{
    /**
     * @return array
     */
    public function fetchCustomerList(): array;

    /**
     * @param int $id
     *
     * @return array
     */
    public function fetchCustomerById(int $id): array;

    /**
     * @param array $data
     *
     * @return array
     */
    public function createCustomer(array $data): array;

    /**
     * @param int   $id
     * @param array $data
     *
     * @return array
     */
    public function updateCustomer(int $id, array $data): array;

    /**
     * @param int $id
     *
     * @return array
     */
    public function deleteCustomer(int $id): array;
}
