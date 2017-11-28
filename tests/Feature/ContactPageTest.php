<?php

namespace Tests\Feature;

use Tests\TestCase;

/**
 * @todo implement docblock
 */
class ContactPageTest extends TestCase
{
    /**
     * @test
     * @testdox Test the contact front-end page
     * @covers  \App\Http\Controllers\ContactController::index()
     */
    public function frontendContactPage()
    {
        $this->get(route('contact.index'))->assertStatus(200);
    }
}
