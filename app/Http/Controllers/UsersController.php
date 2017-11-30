<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsersValidator;
use App\Repositories\UsersRepository;
use App\Repositories\RoleRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\View\View;

/**
 * UsersController
 *
 * @package    \App\Http
 * @subpackage Controllers
 * @author     Tim Joosten <tim@activisme.be>
 */
class UsersController extends Controller
{
    private $usersRepository; /** @var UsersRepository $usersRepository */
    private $roleRepository;  /** @var RoleRepository  $roleRepository  */

    /**
     * UsersController constructor
     *
     * @todo register admin middleware.
     *
     * @param RoleRepository  $roleRepository  The abstraction layer between database and controller. 
     * @param UsersRepository $usersRepository The abstraction layer between database and controller.
     *
     * @return void
     */
    public function __construct(UsersRepository $usersRepository, RoleRepository $roleRepository)
    {
        $this->middleware(['auth', 'role:admin']);

        $this->roleRepository  = $roleRepository;
        $this->usersRepository = $usersRepository;
    }

    /**
     * Display the user index for the application.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        return view('users.index', ['users' => $this->usersRepository->paginate(20)]);
    }

    /**
     * The create view for a newly user.
     *
     * @return \Illuminate\View\View
     */
    public function create(): View
    {
        return view('users.create', ['roles' => $this->roleRepository->all()]);
    }

    /**
     * Store the new user in the system.
     *
     * @todo build up the validator.
     * @todo Implement mail notification to the created user
     * @todo write the phpunit test.
     * @todo implement activity monitor.
     *
     * @param  Usersvalidator $input The user given input. (Validated)
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Usersvalidator $input): RedirectResponse
    {
        $password = bcrypt(str_random(20));
        $input->merge(['password' => $password]);

        if ($user = $this->usersRepository->create($input->except(['_token', 'role']))) {
            $user->roles()->attach($input->role); // Attach the given roles to the user.
            flash("Er is een login voor {$user->name} aangemaakt in het systeem.")->success();
        }

        return redirect()->route('users.index');
    }

    /**
     * Edit view for s apcific user.
     *
     * @todo build up the view.
     * @todo write phpunit test.
     *
     * @param int $user The unique identifier in the storage
     *
     * @return \Illuminate\View\View
     */
    public function edit($user): View
    {
        $user = $this->usersRepository->find($user) ?: abort(Response::HTTP_NOT_FOUND);
        return view('users.edit', compact('user'));
    }

    /**
     * Update an user in the storage.
     *
     * @todo Create the validator.
     * @todo write phpunit test.
     * @todo implement activity monitor
     *
     * @param UsersValidator $input The given user input. (Validated)
     * @param int            $user  The unique identifier in the storage
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UsersValidator $input, $user): RedirectResponse
    {
        $user = $this->usersRepository->find($user) ?: abort(Response::HTTP_NOT_FOUND);

        if ($user->update($input->except('_token'))) {
            flash("{$user->name} is aangepast in het systeem.")->success();
        }

        return redirect()->route('users.index');
    }

    /**
     * Delete the user out of the system.
     *
     * @todo implement activity monitor.
     *
     * @param int $user The uniqie identifier in the storage.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($user): RedirectResponse
    {
        $user = $this->usersRepository->find($user) ?: abort(Response::HTTP_NOT_FOUND);

        if ($user->delete()) {
            flash("{$user->name} is verwijderd als gebruiker uit het platform.")->success();
        }

        return redirect()->route('users.index');
    }
}
