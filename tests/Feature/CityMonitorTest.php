<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * @todo docblock
 */
class CityMonitorTest extends TestCase
{
    /**
     * @test
     * @testdox Test if the index page for the city monitor is rendered successful.
     *
     * @covers \App\Http\Controllers\CityMonitorController::__construct()
     * @covers \App\Http\Controllers\CityMonitorController::index()
     */
    public function indexPageauthenticated()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->assertAuthenticatedAs($user)
            ->get(route('city-monitor.index'))
            ->assertStatus(200);
    }

    /**
     * @test
     * @testdox Test the error response when some unauthenticated user access the monitor
     *
     * @covers \App\Http\Controllers\CityMonitorController::__construct()
     * @covers \App\Http\Controllers\CityMonitorController::index()
     */
    public function indexPageUnauthenticated()
    {
        $this->get(route('city-monitor.index'))->assertStatus(302)->assertRedirect(route('login'));
    }
}
