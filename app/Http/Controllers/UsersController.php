<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserValidator;
use App\Repositories\UsersRepository;
use Illuminate\Http\Request;
use Illuminate\View\View; 
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

/**
 * UsersController
 *
 * @package    \App\Http
 * @subpackage Controllers
 * @author     Tim Joosten <tim@activisme.be>
 */
class UsersController extends Controller
{
    private $usersController; /** @var UsersRepository $usersRepository */

    /**
     * UsersController constructor
     *
     * @param UsersRepository $usersRepository The abstraction layer between database and controller. 
     * 
     * @return void
     */
    public function __construct(UsersRepository $usersRepository) 
    {
        $this->middleware(['auth']); 
        $this->usersRepository = $usersRepository;
    }

    /**
     * Display the user index for the application. 
     *
     * @todo Register route 
     * @todo write phpunit test 
     * @todo build up the view.
     * 
     * @return \Illuminate\View\View
     */
    public function index(): View 
    {
        //
    }

    /**
     * The create view for a newly user. 
     *
     * @todo implement controller logic. 
     * @todo build up the view. 
     * @todo Write the phpunit test 
     * @todo Register the route
     * 
     * @return \Illuminate\View\View
     */
    public function create(): View
    {
        //
    }

    /**
     * Store the new user in the system.
     *
     * @todo build up the validator. 
     * @todo Implement mail notification to the created user
     * @todo write the phpunit test. 
     * 
     * @param  Usersvalidator $input The user given input. (Validated)
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Usersvalidator $input): RedirectResponse
    {
        $password = bcrypt(str_random(20)); 
        $input->merge(['password' => $password]); 

        if ($user = $this->usersRepository->create($input->except('_token'))) {
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
     * @todo wrtie phpunit test.
     * 
     * @param UsersValidator $input The given user input. (Validated)
     * @param int            $user  The unique identifier in the storage
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UsersValidator $input, $user): RedirectResponse 
    {
        $user = $this->usersRepository->find($user) ?: abort(Response::HTTP_NOT_FOUND);

        if ($user->update($input->except('_token')) {
            flash("{$user->name} is aangepast in het systeem.")->success();
        }

        return redirect()->route('users.index');
    }

    /**
     * Delete the user out of the system. 
     *
     * @todo write phpunit test
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
