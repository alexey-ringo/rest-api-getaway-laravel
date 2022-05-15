<?php declare(strict_types = 1);

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TestTest extends TestCase
{
    use RefreshDatabase;

    public function testTest()
    {
        self::assertTrue(true);
    }
}
