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
     * @covers  \App\Http\Controllers\ContactController::create()
     */
    public function frontendContactPage()
    {
        $this->get(route('contact.index'))->assertStatus(200);
    }

    /**
     * @test 
     * @testdox Test if the validation return from the controller. 
     * @covers  \App\Http\Controllers\ContactController::store() 
     */
    public function contactStoreValidationErrors()
    {
        $this->post(route('contact.store'), [])
            ->assertSessionHasErrors() 
            ->assertStatus(302)
            ->assertSessionMissing([
                'flash_notification.0.message'  => 'Je bericht is verzonden. Wij zullen snel je bericht bekijken en antwoorden indien nodig.',
                'flash_notification.0.level'    => 'success'
            ]);
    }

    /**
     * @test 
     * @testdox Test if the contact message can be stored in the database. 
     * @covers  \App\Http\Controllers\ContactController::store()
     */
    public function contactStoreOk() 
    {
        $input = ['name' => 'test', 'email' => 'qd@gmail.com', 'subject' => 'service', 'message' => 'fdfd']; 

        $this->post(route('contact.store'), $input)
            ->assertStatus(302)
            ->assertSessionhas([
                'flash_notification.0.message'  => 'Je bericht is verzonden. Wij zullen snel je bericht bekijken en antwoorden indien nodig.',
                'flash_notification.0.level'    => 'success'
            ]);

        $this->assertDatabaseHas('contacts', $input);
    }
}
