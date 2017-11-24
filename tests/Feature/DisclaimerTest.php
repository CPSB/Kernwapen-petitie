<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DisclaimerTest extends TestCase
{
    /**
     * @test
     * @testdox Test if the disclaimer is accessible.
     * @covers \App\Http\Controllers\IndexController::index()
     */
    public function frontpage()
    {
        $this->get(route('disclaimer.index'))->assertStatus(200);
    }
}
