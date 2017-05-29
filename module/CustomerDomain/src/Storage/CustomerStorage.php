<?php
/**
 * IPC2017 Zend\Expressive Workshop
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/RalfEggert/ipc2017-expressive
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace CustomerDomain\Storage;

use Zend\Db\ResultSet\ResultSet;
use Zend\Db\Sql\Expression;
use Zend\Db\TableGateway\TableGateway;

/**
 * Class CustomerStorage
 *
 * @package CustomerDomain\Storage
 */
class CustomerStorage implements CustomerStorageInterface
{
    /**
     * @var TableGateway
     */
    private $tableGateway;

    /**
     * CustomerStorage constructor.
     *
     * @param TableGateway $tableGateway
     */
    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    /**
     * @return array
     */
    public function fetchCustomerRows(): array
    {
        $select = $this->tableGateway->getSql()->select();
        $select->order('last_name');

        /** @var ResultSet $resultSet */
        $resultSet = $this->tableGateway->selectWith($select);

        return $resultSet->toArray();
    }

    /**
     * @param int $id
     *
     * @return array
     */
    public function fetchSingleById(int $id): array
    {
        $select = $this->tableGateway->getSql()->select();
        $select->where->equalTo('id', $id);

        /** @var ResultSet $resultSet */
        $resultSet = $this->tableGateway->selectWith($select);

        return $resultSet->current();
    }

    /**
     * @param array $data
     *
     * @return bool
     */
    public function createCustomer(array $data): bool
    {
        $insert = $this->tableGateway->getSql()->insert();
        $insert->values($data);

        return $this->tableGateway->insertWith($insert) > 0;
    }

    /**
     * @param int   $id
     * @param array $data
     *
     * @return bool
     */
    public function updateCustomer(int $id, array $data): bool
    {
        $update = $this->tableGateway->getSql()->update();
        $update->set($data);
        $update->where->equalTo('id', $id);

        return $this->tableGateway->updateWith($update) > 0;
    }

    /**
     * @param int $id
     *
     * @return bool
     */
    public function deleteCustomer(int $id): bool
    {
        $delete = $this->tableGateway->getSql()->delete();
        $delete->where->equalTo('id', $id);

        return $this->tableGateway->deleteWith($delete) > 0;
    }
}
