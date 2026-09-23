<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class ConsoleSafetyTest extends TestCase
{
    use RefreshDatabase;

    public function test_route_list_runs_on_fresh_unseeded_database(): void
    {
        // Regression test: HomeController's constructor used to echo the
        // "site closed" page and call exit() whenever the settings row was
        // missing, which killed artisan commands (route:list, etc.) on a
        // fresh database. Before the fix, the exit() call below would
        // terminate the entire PHPUnit process; now it must return 0.
        $exitCode = Artisan::call('route:list');

        $this->assertSame(0, $exitCode);
    }
}
