<?php
/**
 * IPC2017 Zend\Expressive Workshop
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/RalfEggert/ipc2017-expressive
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace CustomerDomain\Repository;

/**
 * Interface CustomerRepositoryInterface
 *
 * @package CustomerDomain\Repository
 */
/**
 * Interface CustomerRepositoryInterface
 *
 * @package CustomerDomain\Repository
 */
interface CustomerRepositoryInterface
{
    /**
     * @return array
     */
    public function getCustomerList(): array;

    /**
     * @param int $id
     *
     * @return array
     */
    public function getCustomerById(int $id): array;

    /**
     * @param array $data
     *
     * @return bool
     */
    public function saveCustomer(array $data): bool;

    /**
     * @param int $id
     *
     * @return bool
     */
    public function removeCustomer(int $id): bool;
}
