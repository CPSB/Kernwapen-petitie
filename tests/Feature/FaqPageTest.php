<?php

namespace Tests\Feature;

use App\Faq;
use Tests\TestCase;

/**
 * @todo docblock
 */
class FaqPageTest extends TestCase
{
    /**
     * @test
     * @testdox Test if the front page is rendered successful.
     *
     * @covers \App\Http\Controllers\FaqController::__construct()
     * @covers \App\Http\Controllers\FaqController::index()
     */
    public function FrontIndexPage()
    {
        factory(Faq::class)->create();
        $this->get(route('faq.index'))->assertStatus(200);
    }
}
