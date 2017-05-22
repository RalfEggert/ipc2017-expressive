<?php
/**
 * IPC2017 Zend\Expressive Workshop
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/RalfEggert/ipc2017-expressive
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace CustomerDomain;

use CustomerDomain\Repository\CustomerRepositoryFactory;
use CustomerDomain\Repository\CustomerRepositoryInterface;
use CustomerDomain\Storage\CustomerStorageFactory;
use CustomerDomain\Storage\CustomerStorageInterface;

/**
 * Class ConfigProvider
 *
 * @package CustomerDomain
 */
class ConfigProvider
{
    /**
     * @return array
     */
    public function __invoke(): array
    {
        return [
            'dependencies' => $this->getDependencies(),
        ];
    }

    /**
     * @return array
     */
    public function getDependencies(): array
    {
        return [
            'factories' => [
                CustomerRepositoryInterface::class =>
                    CustomerRepositoryFactory::class,

                CustomerStorageInterface::class =>
                    CustomerStorageFactory::class,
            ],
        ];
    }
}
