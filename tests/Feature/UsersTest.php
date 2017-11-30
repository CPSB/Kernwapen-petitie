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
     * @covers      \App\Http\Controllers\UsersController::destroy()
     */
    public function deleteUserUnauthencated()
    {
        $user = factory(User::class)->create();

        $this->get(route('users.delete', $user))
            ->assertStatus(302)
            ->assertRedirect(route('login'));
    }

    /**
     * @test
     * @testdox    Test the response if we try to delete a user with an invalid id.
     * @covers     \App\Http\Controllers\UsersController::destroy()
     */
    public function deleteUserWrongId()
    {
        $role = factory(Role::class)->create(['name' => 'admin']);
        $user = factory(User::class, 2)->create();

        $user[0]->assignRole($role->name); // attach permissions

        $this->actingAs($user[0])
            ->assertAuthenticatedAs($user[0])
            ->get(route('users.delete', ['id' => 10000]))
            ->assertStatus(404);
    }

    /**
     * @test
     * @testdox Test if we can delete a user with the correct id and permissions
     * @covers  \App\Http\Controllers\UsersController::destroy()
     */
    public function deleteUserCorrectId()
    {
        $role = factory(Role::class)->create(['name' => 'admin']);
        $user = factory(User::class, 2)->create();

        $user[0]->assignRole($role->name); // Attachment user role

        $this->actingAs($user[0])
            ->assertAuthenticatedAs($user[0])
            ->get(route('users.delete', $user[1]))
            ->assertStatus(302)
            ->assertSessionHas([
                'flash_notification.0.message'  => "{$user[1]->name} is verwijderd als gebruiker uit het platform.",
                'flash_notification.0.level'    => 'success'
            ]);

        $this->assertDatabaseMissing('users', ['id' => $user[1]->id]);
    }

    /**
     * @test
     * @testdox Test if a user with incorrect permissions can delete an user.
     * @covers  \App\Http\Controllers\UsersController::destroy()
     */
    public function deleteUserDeleteUnauthorizedUser()
    {
        $role = factory(Role::class)->create(['name' => 'user']);
        $user = factory(User::class, 2)->create();

        $user[0]->assignRole($role->name); // Attachment roles

        $this->actingAs($user[0])
            ->assertAuthenticatedAs($user[0])
            ->get(route('users.delete', $user[1]))
            ->assertStatus(403);
    }

    /**
     * @test
     * @testdox Test the response if an unauthenticated user access the update route.
     * @covers  \App\Http\Controllers\UsersController::update()
     */
    public function editUserUnauthenticated()
    {
        $user = factory(User::class)->create();
        $role = factory(Role::class)->create();

        $input = ['name' => 'John Doe', 'email' => 'name@domain.tld', 'role' => $role->id];

        $this->post(route('users.update', $user), $input)
            ->assertStatus(302)
            ->assertRedirect(route('login'));
    }

    /**
     * @test
     * @testdox Test the error response if we give an wrong user id.
     * @covers  \App\Http\Controllers\UsersController::update()
     */
    public function editUserWrongId()
    {
        $role = factory(Role::class)->create(['name' => 'admin']);
        $user = factory(User::class)->create()->assignRole($role->name);

        $input = ['name' => 'John Doe', 'email' => 'name@domain.tld', 'role' => $role->id];

        $this->actingAs($user)
            ->assertAuthenticatedAs($user)
            ->post(route('users.update', ['id' => 100000]), $input)
            ->assertStatus(404);
    }

    /**
     * @test
     * @testdox Test the error response if the user visit unauthenticated the edit route.
     * @covers  \App\Http\Controllers\UsersController::update()
     */
    public function editUserUnauthorized()
    {
        $role = factory(Role::class)->create(['name' => 'user']);
        $user = factory(User::class)->create()->assignRole($role->name);

        $input = ['name' => 'John Doe', 'email' => 'name@domain.tld', 'role' => $role->id];

        $this->actingAs($user)
            ->assertAuthenticatedAs($user)
            ->post(route('users.update', $user), $input)
            ->assertStatus(403);
    }

    /**
     * @test
     * @testdox Test if we can successful edit some given user.
     * @covers  \App\Http\Controllers\UsersController::update()
     */
    public function editUserOk()
    {
        $role = factory(Role::class)->create(['name' => 'admin']);
        $user = factory(User::class, 2)->create();

        $user[0]->assignRole(['name' => $role->name]); // Role attachment

        $input = ['name' => 'John Doe', 'email' => 'name@domain.tld', 'role' => $role->id];

        $this->actingAs($user[0])
            ->assertAuthenticatedAs($user[0])
            ->post(route('users.update', $user[1]), $input)
            ->assertStatus(302)
            ->assertSessionHas(['flash_notification.0.level' => 'success']);
    }

    /**
     * @test
     * @testdox Test if the validation errors return from the controller.
     * @covers  \App\Http\Controllers\UsersController::update()
     */
    public function editUserValidationErrors()
    {
        $role = factory(Role::class)->create(['name' => 'admin']);
        $user = factory(User::class)->create()->assignRole($role->name);

        $this->actingAs($user)
            ->post(route('users.update', $user), [])
            ->assertStatus(302)
            ->assertSessionHasErrors();
    }

    /**
     * @test
     * @testdox Test the response when we successful access the view.
     * @covers  \App\Http\Controllers\UsersController::edit()
     */
    public function editViewUserOk()
    {
        $role = factory(Role::class)->create(['name' => 'admin']);
        $user = factory(User::class, 2)->create();

        $user[0]->assignRole($role->name); // Role attachment.

        $this->actingAs($user[0])
            ->assertAuthenticatedAs($user[0])
            ->get(route('users.edit', $user[1]))
            ->assertStatus(200);
    }

    /**
     * @test
     * @testdox Test the response if we access the update view unauthenticated
     * @covers  \App\Http\Controllers\UsersController::edit()
     */
    public function editViewUserUnauthenticated()
    {
        $user = factory(User::class)->create();
        $this->get(route('users.edit', $user))->assertStatus(302)->assertRedirect(route('login'));
    }

    /**
     * @test
     * @testdox Test if the user can access the edit view with wrong permissions.
     * @covers  \App\Http\Controllers\UsersController::edit()
     */
    public function editViewUserWrongPermissions()
    {
        $role = factory(Role::class)->create(['name' => 'user']);
        $user = factory(User::class, 2)->create();

        $user[0]->assignRole($role->name); // Role attachment

        $this->actingAs($user[0])
            ->assertAuthenticatedAs($user[0])
            ->get(route('users.edit', $user[1]))
            ->assertStatus(403);
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
        $this->get(route('users.create'))->assertStatus(302)->assertRedirect(route('login'));
    }

    /**
     * @test
     * @testox  Test the error response when a user with wrong permissions try to access the page.
     * @covers  \App\Http\Controllers\UsersController::create()
     */
    public function usersCreateViewWrongPermissions()
    {
        $role = factory(Role::class)->create(['name' => 'user']);
        $user = factory(User::class)->create();

        $user->assignRole($role->name); // Role attachment

        $this->actingAs($user)
            ->assertAuthenticatedAs($user)
            ->get(route('users.create'))
            ->assertStatus(403);
    }

    /**
     * @test
     * @testdox Test the users create view.
     * @covers  \App\Http\Controllers\UsersController::create()
     */
    public function usersCreateViewOk()
    {
        $role = factory(Role::class)->create(['name' => 'admin']);
        $user = factory(User::class)->create();

        $user->assignRole($role->name); // Role attachment.

        $this->actingAs($user)
            ->assertAuthenticatedAs($user)
            ->get(route('users.create'))
            ->assertStatus(200);
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
