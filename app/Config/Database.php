<?php

namespace Config;

use CodeIgniter\Database\Config;

/**
 * Database Configuration
 */
class Database extends Config
{
    /**
     * The directory that holds the Migrations
     * and Seeds directories.
     */
    public string $filesPath = APPPATH . 'Database' . DIRECTORY_SEPARATOR;

    /**
     * Lets you choose which connection group to
     * use if no other is specified.
     */
    public string $defaultGroup = 'default';

    /**
     * The default database connection.
     */
    // public array $default = [
    //     'DSN'      => '',
    //     'hostname' => '10.19.16.21',
    //     'username' => 'sa',
    //     'password' => 'User@new1',
    //     'database' => 'production_control_v2',
    //     'DBDriver' => 'sqlsrv',
    //     'DBPrefix' => '',
    //     'pConnect' => false,
    //     'DBDebug'  => true,
    //     'charset'  => 'utf8',
    //     'DBCollat' => 'utf8_general_ci',
    //     'swapPre'  => '',
    //     'encrypt'  => false,
    //     'compress' => false,
    //     'strictOn' => false,
    //     'failover' => [],
    //     'port'     => 1433,
    // ];
    public array $default = [
        'DSN'      => '',
        'hostname' => 'localhost',
        'username' => 'user',
        'password' => '12345',
        'database' => 'Pasting',
        'DBDriver' => 'sqlsrv',
        'DBPrefix' => '',
        'pConnect' => false,
        'DBDebug'  => true,
        'charset'  => 'utf8',
        'DBCollat' => 'utf8_general_ci',
        'swapPre'  => '',
        'encrypt'  => false,
        'compress' => false,
        'strictOn' => false,
        'failover' => [],
        'port'     => 1433,
    ];

    public array $manajemen_rak = [
        'DSN'      => '',
        'hostname' => 'localhost',
        'username' => 'user',
        'password' => '12345',
        'database' => 'manajemen_rak',
        'DBDriver' => 'sqlsrv',
        'DBPrefix' => '',
        'pConnect' => false,
        'DBDebug'  => true,
        'charset'  => 'utf8',
        'DBCollat' => 'utf8_general_ci',
        'swapPre'  => '',
        'encrypt'  => false,
        'compress' => false,
        'strictOn' => false,
        'failover' => [],
        'port'     => 1433,
    ];

    // public array $default = [
    //     'DSN'      => '',
    //     'hostname' => '10.19.22.102',
    //     'username' => 'sa',
    //     'password' => 'admin',
    //     'database' => 'production_control_v2',
    //     'DBDriver' => 'sqlsrv',
    //     'DBPrefix' => '',
    //     'pConnect' => false,
    //     'DBDebug'  => true,
    //     'charset'  => 'utf8',
    //     'DBCollat' => 'utf8_general_ci',
    //     'swapPre'  => '',
    //     'encrypt'  => false,
    //     'compress' => false,
    //     'strictOn' => false,
    //     'failover' => [],
    //     'port'     => 1433,
    // ];

    public array $sqlsrv = [
        'DSN'      => '',
        'hostname' => '10.19.16.21',
        'username' => 'sa',
        'password' => 'User@new1',
        'database' => 'portal_ppc',
        'DBDriver' => 'sqlsrv',
        'DBPrefix' => '',
        'pConnect' => false,
        'DBDebug'  => true,
        'charset'  => 'utf8',
        'DBCollat' => 'utf8_general_ci',
        'swapPre'  => '',
        'encrypt'  => false,
        'compress' => false,
        'strictOn' => false,
        'failover' => [],
        'port'     => 1433,
    ];

    public array $baan = [
        'DSN'      => '',
        'hostname' => '(DESCRIPTION=(ADDRESS=(PROTOCOL=TCP)(HOST=10.19.16.7)(PORT=1521)) (CONNECT_DATA=(SERVER=DEDICATED) (SERVICE_NAME = BAANS.INCOE.ASTRA.CO.ID)))',
        'username' => 'system',
        'password' => 'M1s6789',
        'database' => '',
        'DBDriver' => 'oci8',
        'DBPrefix' => '',
        'pConnect' => false,
        'DBDebug'  => true,
        'charset'  => 'utf8',
        'DBCollat' => 'utf8_general_ci',
        'swapPre'  => '',
        'encrypt'  => false,
        'compress' => false,
        'strictOn' => false,
        'failover' => [],
        'port'     => 1521,
    ];

    public array $prod_control = [
        'DSN'      => '',
        'hostname' => '10.19.16.19',
        'username' => 'prod_control',
        'password' => 'newpass001',
        'database' => 'production_control',
        'DBDriver' => 'mysqli',
        'DBPrefix' => '',
        'pConnect' => false,
        'DBDebug'  => true,
        'charset'  => 'utf8',
        'DBCollat' => 'utf8_general_ci',
        'swapPre'  => '',
        'encrypt'  => false,
        'compress' => false,
        'strictOn' => false,
        'failover' => []
        // 'port'     => 1521,
    ];

    /**
     * This database connection is used when
     * running PHPUnit database tests.
     */
    public array $tests = [
        'DSN'         => '',
        'hostname'    => '127.0.0.1',
        'username'    => '',
        'password'    => '',
        'database'    => ':memory:',
        'DBDriver'    => 'SQLite3',
        'DBPrefix'    => 'db_',  // Needed to ensure we're working correctly with prefixes live. DO NOT REMOVE FOR CI DEVS
        'pConnect'    => false,
        'DBDebug'     => true,
        'charset'     => 'utf8',
        'DBCollat'    => 'utf8_general_ci',
        'swapPre'     => '',
        'encrypt'     => false,
        'compress'    => false,
        'strictOn'    => false,
        'failover'    => [],
        'port'        => 3306,
        'foreignKeys' => true,
        'busyTimeout' => 1000,
    ];

    public function __construct()
    {
        parent::__construct();

        // Ensure that we always set the database group to 'tests' if
        // we are currently running an automated test suite, so that
        // we don't overwrite live data on accident.
        if (ENVIRONMENT === 'testing') {
            $this->defaultGroup = 'tests';
        }
    }
}
