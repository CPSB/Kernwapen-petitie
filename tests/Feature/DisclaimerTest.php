<?php

namespace Tests\Feature;

use Tests\TestCase;

class DisclaimerTest extends TestCase
{
    /**
     * @test
     * @testdox Test if the disclaimer is accessible.
     * @covers \App\Http\Controllers\DisclaimerController::index()
     */
    public function frontpage()
    {
        $this->get(route('disclaimer.index'))->assertStatus(200);
    }
}
