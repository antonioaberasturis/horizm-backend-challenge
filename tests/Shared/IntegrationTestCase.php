<?php

namespace Tests\Shared;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

abstract class IntegrationTestCase extends TestCase
{
    use RefreshDatabase;
}
