<?php

namespace Invertus\Tests\Prestashopdevcon\Integration;

use PHPUnit\Framework\TestCase;

class BaseTestCase extends TestCase
{
    protected $backupGlobals = false;

    protected function setUp(): void
    {
        parent::setUp();
        \Db::getInstance()->execute('START TRANSACTION;');
    }

    protected function tearDown(): void
    {
        \Db::getInstance()->execute('ROLLBACK;');
        parent::tearDown();
    }
}
