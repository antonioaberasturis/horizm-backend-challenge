<?php

declare(strict_types=1);

namespace Tests\Application;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

abstract class ConsoleApplicationAcceptanceTestCase extends TestCase
{
    use RefreshDatabase;
}
