<?php

namespace Tests\Feature;

use Tests\TestCase;

class ContactPageTest extends TestCase
{
    /**
     * @test
     * @testdox Test the contact front-end page
     * @covers  \App\Http\Controllers\ContactController::create()
     */
    public function frontendContactPage()
    {
        $this->get(route('contact.index'))->assertStatus(200);
    }
}