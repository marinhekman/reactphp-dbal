<?php


namespace Drift\DBAL\Tests;

use Doctrine\DBAL\Platforms\PostgreSqlPlatform;
use Drift\DBAL\Connection;
use Drift\DBAL\Credentials;
use Drift\DBAL\Driver\PostgreSQLDriver;
use React\EventLoop\LoopInterface;
use React\Promise\PromiseInterface;

/**
 * Class PostgreSQLConnectionTest
 */
class PostgreSQLConnectionTest extends ConnectionTest
{
    /**
     * @inheritDoc
     */
    public function getConnection(LoopInterface $loop) : Connection
    {
        $mysqlPlatform = new PostgreSqlPlatform();

        return Connection::createConnected(new PostgreSQLDriver($loop), new Credentials(
            '127.0.0.1',
            '5432',
            'root',
            'root',
            'test'
        ), $mysqlPlatform);
    }

    /**
     * Create database and table
     *
     * @param Connection $connection
     *
     * @return PromiseInterface
     */
    protected function createInfrastructure(Connection $connection) : PromiseInterface
    {
        return $connection
            ->queryBySQL('CREATE TABLE IF NOT EXISTS test (id VARCHAR, field1 VARCHAR, field2 VARCHAR)')
            ->then(function() use ($connection){

                return $connection
                    ->queryBySQL('TRUNCATE TABLE test')
                    ->then(function() use ($connection) {
                        return $connection;
                    });
            });
    }

    /**
     * Drop infrastructure
     *
     * @param Connection $connection
     *
     * @return PromiseInterface
     */
    protected function dropInfrastructure(Connection $connection) : PromiseInterface
    {
        return $connection
            ->queryBySQL('DROP TABLE test')
            ->then(function() use ($connection){
                return $connection;
            });
    }
}