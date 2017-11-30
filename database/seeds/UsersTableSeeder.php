<?php

use App\Repositories\PermissionRepository;
use App\Repositories\RoleRepository;
use App\Repositories\UsersRepository;
use App\User;
use Illuminate\Database\Seeder;

/**
 * Class UsersTableSeeder
 */
class UsersTableSeeder extends Seeder
{
    private $roleRepository;        /** @var RoleRepository         $roleRepository         */
    private $permissionRepository;  /** @var PermissionRepository   $permissionRepository   */
    private $usersRepository;       /** @var UsersRepository        $usersRepository        */

    /**
     * UsersTableSeeder Constructor
     *
     * @param RoleRepository        The bastraction layer between database and controller
     * @param PermissionRepository  The abstraction layer between database and controller
     * @param UsersRepository       The abstraction layer between database and controller
     *
     * @return void
     */
    public function __construct(RoleRepository $roleRepository, PermissionRepository $permissionRepository, UsersRepository $usersRepository)
    {
        $this->roleRepository       = $roleRepository;
        $this->PermissionRepository = $permissionRepository;
        $this->UsersRepository      = $usersRepository;
    }

    /**
     * Run the database seeds.
     *
     * @todo Translate command outputs.
     *
     * @return void
     */
    public function run()
    {
        // Ask fir database migration refresh, default is no
        if ($this->command->confirm('Do you wish to refresh migrations before seeding, it will clear all old data!')) {
            // Call the php artisan migrate:refresh command.
            $this->command->call('migrate:refresh');
            $this->command->warn('Data cleared, started from blank database.');
        }

        // Confirm roles needed
        if ($this->command->confirm('Create roles for Admins, Verantwoordelijke, Vrijwilliger', true)) {
            // Ask the roles from the input
            $inputRoles = $this->command->ask('Enter roles in comma seperate format.', 'admin, verantwoordelijke, vrijwilliger');
            $rolesArray = explode(',', $inputRoles); // BOOM

            foreach ($rolesArray as $role) { // Add roles
                $role = $this->roleRepository->entity()->firstOrCreate(['name' => trim($role)]);

                if ($role->name == 'admin') { // Assign all permissions
                    $role->syncPermissions($this->PermissionRepository->all());
                    $this->command->info('Admin granted all permissions');
                } else { // For others by default only read access
                    $role->syncPermissions($this->PermissionRepository->entity()->where('name', 'LIKE', 'view_%')->get());
                }

                $this->createUser($role); // Create the user in the database.
            } // ENDIF role
        } // ENDIF Create roles
    } // END run function

    /**
     * Create a user with the given role
     *
     * @param Collection $role The database return from the given role.
     *
     * @return void
     */
    private function createUser($role)
    {
        $user = factory(User::class)->create();
        $user->assignRole($role->name);

        if ($role->name == 'admin') {
            echo "\n";
            $this->command->info('Here is your admin details to login:');
            $this->command->warn($user->email);
            $this->command->warn('Password is "secret"');
            echo "\n";
        }
    }
}
