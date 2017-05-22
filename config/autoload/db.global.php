<?php
/**
 * IPC2017 Zend\Expressive Workshop
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/RalfEggert/ipc2017-expressive
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

return [
    'db' => [
        'driver' => 'pdo',
        'dsn'    => 'mysql:host=SERVER;dbname=DBNAME;charset=utf8',
        'user'   => 'USER',
        'pass'   => 'PASS',
    ],
];