<?php

namespace Tests\Feature;

use App\Role;
use App\User;
use Tests\TestCase;

/**
 * @todo docblock
 */
class UsersTest extends TestCase
{
    /**
     * @test
     * @testdox     Test delete user access when the user in unauthenticated.
     * @covers      \App\Http\Controllers\UserController::destroy()
     */
    public function deleteUserUnauthencated()
    {
        //
    }

    /**
     * @test
     * @testdox    Test the response if we try to delete a user with an invalid id.
     * @covers     \App\Http\Controllers\UserController::destroy()
     */
    public function deleteUserWrongId()
    {
        //
    }

    /**
     * @test
     * @testdox Test if we can delete a user with the correct id and permissions
     * @covers  \App\Http\Controllers\UserController::destroy()
     */
    public function deleteUserCorrectId()
    {
        //
    }

    /**
     * @test
     * @testdox Test if a user with incorrect permissions can delete an user.
     * @covers  \App\Http\Controllers\UsersController::destroy()
     */
    public function deleteUserDeleteUnauthorizedUser()
    {
        //
    }

    /**
     * @test
     * @testdox Test the response if an unauthenticated user access the update route.
     * @covers  \App\Http\Controllers\UsersController::update()
     */
    public function editUserUnauthenticated()
    {
        //
    }

    /**
     * @test
     * @testdox Test the error response if we give an wrong user id.
     * @covers  \App\Http\Controllers\UsersController::update()
     */
    public function editUserWrongId()
    {
        //
    }

    /**
     * @test
     * @testdox Test the error response if the user visit unauthenticated the edit route.
     * @covers  \App\Http\Controllers\UsersController::update()
     */
    public function editUserUnauthorized()
    {
        //
    }

    /**
     * @test
     * @testdox Test if we can successfull edit some given user.
     * @covers  \App\Http\Controllers\UsersController::update()
     */
    public function editUserOk()
    {
        //
    }

    /**
     * @test
     * @testdox Test if the validation errors return from the controller.
     * @covers  \App\Http\Controllers\UsersController::update()
     */
    public function editUserValidationError()
    {
        //
    }

    /**
     * @test
     * @testdox Test the response when we successfull access the view.
     * @covers  \App\Http\Controllers\UsersController::edit()
     */
    public function editViewUserOk()
    {
        //
    }

    /**
     * @test
     * @testdox Test the response if we access the update view unauthenticated
     * @covers  \App\Http\Controllers\UsersController::edit()
     */
    public function editViewUserUnauthenticated()
    {
        //
    }

    /**
     * @test
     * @testdox Test if the user can access the edit view with wrong permissions.
     * @covers  \App\Http\Controllers\UsersController::edit()
     */
    public function editViewUserWrongPermissions()
    {
        //
    }

    /**
     * @test
     * @testdox Test if we can successfull store the new user in the storage.
     * @covers  \App\Http\Controllers\UsersController::store()
     */
    public function userStoreOk()
    {
        //
    }

    /**
     * @test
     * @testdox Test the return of validation errors from the controller.
     * @covers  \App\Http\Controllers\UsersController::store()
     */
    public function userStoreValidationErrors()
    {
        //
    }

    /**
     * @test
     * @testdox Test if we can store a new user if we are unatuhenticated
     * @covers  \App\Http\Controllers\UsersController::store()
     */
    public function userStoreUnAuthenticated()
    {
        //
    }

    /**
     * @test
     * @testdox Test if we can store a user when we have the wrong permissions
     * @covers  \App\Http\Controllers\UsersController::store()
     */
    public function userStoreWrongPermissions()
    {
        //
    }

    /**
     * @test
     * @testdox Test the error response if an unauthenticated user tries to access the create page
     * @covers  \App\Http\Controllers\UsersController::create()
     */
    public function usersCreateViewUnAuthenticated()
    {
        //
    }

    /**
     * @test
     * @testox  Test the error response when a user with wrong permissions try to access the page.
     * @covers  \App\Http\Controllers\UsersController::create()
     */
    public function usersCreateViewWrongPermissions()
    {
        //
    }

    /**
     * @test
     * @testdox Test the users create view.
     * @covers  \App\Http\Controllers\UsersController::create()
     */
    public function usersCreateViewOk()
    {
        //
    }

    /**
     * @test
     * @testdox Test the error when some unauthenticated visitor try to access the users index page.
     * @covers  \App\Http\Controllers\UsersController::index()
     */
    public function usersIndexUnAuthenticated()
    {
        $this->get(route('users.index'))
            ->assertStatus(302)
            ->assertRedirect(route('login'));
    }

    /**
     * @test
     * @testdox Test the error that is throwed when the user has the wrong permissions
     * @covers  \App\Http\Controllers\UsersController::index()
     */
    public function usersIndexWrongPermissions()
    {
        factory(Role::class)->create(['name' => 'user']);

        $user = factory(User::class)->create();
        $user->assignRole('user');

        $this->actingAs($user)
            ->assertAuthenticatedAs($user)
            ->get(route('users.index'))
            ->assertStatus(403);
    }

    /**
     * @test
     * @testdox Test the status from the users index page with all the needed permissions
     * @covers  \App\Http\Controllers\UsersController::index()
     */
    public function usersIndexOk()
    {
        factory(Role::class)->create(['name' => 'admin']);

        $user = factory(User::class)->create();
        $user->assignRole('admin');

        $this->actingAs($user)
            ->assertAuthenticatedAs($user)
            ->get(route('users.index'))
            ->assertStatus(200);
    }
}
