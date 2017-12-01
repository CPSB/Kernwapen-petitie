<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;

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

    /**
     * @test
     * @testdox Test the error response when an unauthencated client access the search method
     *
     * @covers  \App\Http\Controllers\CityMonitorController::search()
     * @covers  \App\Http\Controllers\CityMonitorController::__construct()
     */
    public function searchMethodUnauthenticated()
    {
        $this->call('GET', route('city-monitor.search'), ['term' => 'Goat noise'])
            ->assertStatus(302)
            ->assertRedirect(route('login'));
    }

    /**
     * @test
     * @testdox Test the rendering when the user is authencated and have given a term.
     *
     * @covers \App\Http\Controllers\CityMonitorController::search()
     * @covers \App\Http\Controllers\CityMonitorController::__construct()
     */
    public function searchMethodOk()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->assertAuthenticatedAs($user)
            ->call('GET', route('city-monitor.search'), ['term' => 'Turnhout'])
            ->assertStatus(200);
    }

    /**
     * @test
     * @testdox Test if the validation return frcm controller to view.
     *
     * @covers \App\Http\Controllers\CityMonitorController::search()
     * @covers \App\Http\Controllers\CityMonitorController::__construct()
     */
    public function searchMethodValidationError()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->assertAuthenticatedAs($user)
            ->call('GET', route('city-monitor.search'))
            ->assertSessionHasErrors()
            ->assertStatus(302);
    }
}
