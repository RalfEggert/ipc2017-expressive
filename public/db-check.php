<?php
/**
 * IPC2017 Zend\Expressive Workshop
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/RalfEggert/ipc2017-expressive
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 *
 */

$dsn = 'mysql:host=localhost;dbname=ipc2017-expressive;charset=utf8';
$pdo = new PDO($dsn, 'ipc2017', 'expressive');

$stmt = $pdo->query('SELECT id FROM test');
while ($row = $stmt->fetch())
{
    echo $row['id'] . '<br>';
}
