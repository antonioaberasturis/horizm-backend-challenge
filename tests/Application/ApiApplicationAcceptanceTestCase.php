<?php

declare(strict_types=1);

namespace Tests\Application;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

abstract class ApiApplicationAcceptanceTestCase extends TestCase
{
    use RefreshDatabase;
}
