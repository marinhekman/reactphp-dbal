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

use Doctrine\DBAL\Platforms\PostgreSQLPlatform;
use Drift\DBAL\Connection;
use Drift\DBAL\ConnectionPoolOptions;
use Drift\DBAL\Credentials;
use Drift\DBAL\Driver\PostgreSQL\PostgreSQLDriver;
use Drift\DBAL\SingleConnection;
use React\EventLoop\LoopInterface;

/**
 * Class PostgreSQLConnectionTest.
 */
class PostgreSQLConnectionTest extends ConnectionTest
{
    /**
     * {@inheritdoc}
     */
    public function getConnection(LoopInterface $loop): Connection
    {
        $postgreSQLPlatform = new PostgreSQLPlatform();

        return SingleConnection::createConnected(new PostgreSQLDriver($loop), new Credentials(
            '127.0.0.1',
            '5432',
            'root',
            'root',
            'test'
        ), $postgreSQLPlatform, new ConnectionPoolOptions(10));
    }
}
