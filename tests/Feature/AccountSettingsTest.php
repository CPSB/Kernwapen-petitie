<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

/**
 * @todo: Implement docblock
 */
class AccountSettingsTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions;

    /**
     * @test
     * @testdox Test if some unauthenticated user can access the index page
     *
     * @covers  \App\Http\Controllers\AccountSettingsController::index()
     * @covers  \App\Http\Controllers\AccountSettingsController::__construct()
     */
    public function AccountSettingsUnAuthenticated()
    {
        auth()->logout(); // Be sure that no user is authenticated.
        $this->get(route('account.settings'))->assertRedirect(route('login'));
    }

    /**
     * @test
     * @testdox Test if the account settings page is ok.
     *
     * @covers  \App\Http\Controllers\AccountSettingsController::index()
     * @covers  \App\Http\Controllers\AccountSettingsController::__construct()
     */
    public function accountSettingsIndexNoParam()
    {
        $user = factory(User::class)->create();
        
        $this->actingAs($user)->assertAuthenticatedAs($user)
            ->get(route('account.settings'))->assertStatus(200);
    }

    /**
     * @test
     * @textdox Test if the account settings page is ok with the Information param
     *
     * @covers  \App\Http\Controllers\AccountSettingsController::index()
     * @covers  \App\Http\Controllers\AccountSettingsController::__construct()
     */
    public function accountSettingsIndexInformationParam()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)->assertAuthenticatedAs($user)
            ->get(route('account.settings', ['type' => 'information']))->assertStatus(200);
    }

    /**
     * @test
     * @testdox Test if the account settings page is ok with the Seucrity param
     *
     * @covers  \App\Http\Controllers\AccountSettingsController::index
     * @covers  \App\Http\Controllers\AccountSettingsController::__construct()
     */
    public function accountSettingsIndexSecurityParam()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)->assertAuthenticatedAs($user)
            ->get(route('account.settings', ['type' => 'security']))->assertStatus(200);
    }

    /**
     * @test
     * @testdox Test if an unauthenticated user can update account information.
     *
     * @covers  \App\Http\Controllers\AccountSettingsController::__construct()
     * @covers  \App\Http\Controllers\AccountSettingsController::updateInformation()
     */
    public function accountUpdateInformationUnauthenticated()
    {
        $this->post(route('account.settings.info'), [])->assertRedirect(route('login'));
    }

    /**
     * @test
     * @testdox Test if the validation are returned from the information update controller.
     *
     * @covers  \App\Http\Controllers\AccountSettingsController::updateInformation()
     * @covers  \App\Http\Controllers\AccountSettingsController::__construct()
     */
    public function accountUpdateInformationValidationErrors()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->assertAuthenticatedAs($user)
            ->post(route('account.settings.info'), [])
            ->assertStatus(302)
            ->assertSessionHasErrors();
    }

    /**
     * @test
     * @testdox Test if the user information can be successful changed in the storage
     *
     * @covers  \App\Http\Controllers\AccountSettingsController::updateInformation()
     * @covers  \App\Http\Controllers\AccountSettingsController::__construct()
     */
    public function accountUpdateInformationNoErrors()
    {
        $user  = factory(User::class)->create();
        $input = ['name' => 'new username', 'email' => 'new@email.tld'];

        $this->actingAs($user)
            ->assertAuthenticatedAs($user)
            ->post(route('account.settings.info'), $input)
            ->assertStatus(302);

        $this->assertDatabaseHas('users', array_merge(['id' => $user->id], $input));
    }

    /**
     * @test
     * @testdox Test if an authenticated user can access the account security update route.
     *
     * @covers  \App\Http\Controllers\AccountSettingsController::updateSecurity()
     * @covers  \App\Http\Controllers\AccountSettingsController::__construct()
     */
    public function accountUpdateSecurityUnauthenticated()
    {
        $this->post(route('account.settings.sec'), [])->assertRedirect(route('login'));
    }

    /**
     * @test
     * @testdox Test if the validation return from the account security update controller.
     *
     * @covers  \App\Http\Controllers\AccountSettingsController::__construct()
     * @covers  \App\Http\Controllers\AccountSettingsController::updateSecurity()
     */
    public function accountUpdateSecurityValidationErrors()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->assertAuthenticatedAs($user)
            ->post(route('account.settings.sec'), [])
            ->assertStatus(302)
            ->assertSessionHasErrors();
    }

    /**
     * @test
     * @testdox Test if the currently authenticated user can change his account security
     *
     * @covers  \App\Http\Controllers\AccountSettingsController::__construct()
     * @covers  \App\Http\Controllers\AccountSettingsController::updateSecurity()
     */
    public function accountUpdateSecurityNoErrors()
    {
        $user = factory(User::class)->create();
        $input = ['password' => 'new password', 'password_confirmation' => 'new password'];

        $this->actingAs($user)
            ->assertAuthenticatedAs($user)
            ->post(route('account.settings.sec'), $input)
            ->assertStatus(302)
            ->assertSessionHas([
                'flash_notification.0.message'  => "Uw account beveiliging is aangepast.",
                'flash_notification.0.level'    => 'success'
            ]);
    }
}
