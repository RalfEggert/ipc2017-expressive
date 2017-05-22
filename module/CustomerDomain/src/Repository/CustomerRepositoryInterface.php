<?php
/**
 * IPC2017 Zend\Expressive Workshop
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/RalfEggert/ipc2017-expressive
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace CustomerDomain\Repository;

use DomainException;

/**
 * Interface CustomerRepositoryInterface
 *
 * @package CustomerDomain\Repository
 */
interface CustomerRepositoryInterface
{
    /**
     * @return array
     * @throws DomainException
     */
    public function getCustomerList(): array;

    /**
     * @param int $id
     *
     * @return array
     * @throws DomainException
     */
    public function getCustomerById(int $id): array;

    /**
     * @param $data
     *
     * @return bool
     */
    public function saveCustomer($data): bool;

    /**
     * @param $data
     *
     * @return bool
     */
    public function deleteCustomer($data): bool;
}
