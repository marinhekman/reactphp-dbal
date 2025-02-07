<?php

/*
 * This file is part of the DriftPHP Project
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * Feel free to edit as you please, and have fun.
 *
 * @author Marc Morera <yuhu@mmoreram.com>
 */

declare(strict_types=1);

namespace Drift\DBAL\Tests;

use Doctrine\DBAL\Platforms\MySQLPlatform;
use Drift\DBAL\Connection;
use Drift\DBAL\ConnectionPool;
use Drift\DBAL\Credentials;
use Drift\DBAL\Driver\Mysql\MysqlDriver;
use React\EventLoop\LoopInterface;

/**
 * Class Mysql5ConnectionPoolTest.
 */
class Mysql5ConnectionPoolTest extends ConnectionTest
{
    /**
     * {@inheritdoc}
     */
    protected function getConnection(LoopInterface $loop): Connection
    {
        $mysqlPlatform = new MySQLPlatform();

        return ConnectionPool::createConnected(new MysqlDriver(
            $loop
        ), new Credentials(
            '127.0.0.1',
            '3306',
            'root',
            'root',
            'test',
            [], 10
        ), $mysqlPlatform);
    }
}
