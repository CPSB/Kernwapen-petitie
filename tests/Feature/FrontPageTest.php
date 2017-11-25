<?php

namespace Tests\Feature;

use Tests\TestCase;

/**
 * @todo: Implement docblock
 */
class FrontPageTest extends TestCase
{
    /**
     * @test
     * @testdox Test if the fontpage is accessible.
     * @covers  \App\Http\Controllers\IndexController::index()
     */
    public function frontpage()
    {
        $this->get(route('/'))->assertStatus(200);
    }
}
