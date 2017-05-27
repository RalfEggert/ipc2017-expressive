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
 * Class CustomerRepository
 *
 * @package CustomerDomain\Repository
 */
class CustomerRepository implements CustomerRepositoryInterface
{
    /**
     * @var array
     */
    private $data = [];

    /**
     * CustomerRepository constructor.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * @return array
     * @throws DomainException
     */
    public function getCustomerList(): array
    {
        if (empty($this->data)) {
            throw new DomainException('No customer data');
        }

        return $this->data;
    }

    /**
     * @param int $id
     *
     * @return array
     * @throws DomainException
     */
    public function getCustomerById(int $id): array
    {
        if (!isset($this->data[$id])) {
            throw new DomainException('Unknown customer id');
        }

        return $this->data[$id];
    }
}
