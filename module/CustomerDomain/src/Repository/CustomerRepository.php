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
     */
    public function getCustomerList(): array
    {
        return $this->data;
    }

    /**
     * @param int $id
     *
     * @return array
     */
    public function getCustomerById(int $id): array
    {
        if (!isset($this->data[$id])) {
            throw new \DomainException('Id nicht bekannt');
        }

        return $this->data[$id];
    }
}
