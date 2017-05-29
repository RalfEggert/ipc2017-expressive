<?php
/**
 * IPC2017 Zend\Expressive Workshop
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/RalfEggert/ipc2017-expressive
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace CustomerApp;

class ConfigProvider
{
    public function __invoke() : array
    {
        var_dump(__METHOD__);

        return [
            'dependencies' => [],
            'templates'    => [],
        ];
    }
}
