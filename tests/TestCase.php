<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Mockery;

abstract class TestCase extends BaseTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Mockery::close();
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}
