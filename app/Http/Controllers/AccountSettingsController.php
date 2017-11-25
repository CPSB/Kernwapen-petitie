<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

/**
 * AccountSettingsController
 *
 * @package    \App\Http
 * @subpackage Controllers
 * @author     Tim Joosten <tim@activisme.be>
 */
class AccountSettingsController extends Controller
{
    private $usersRepository; /** @var UserRepository $usersRepository */

    /**
     * Account SettingsController
     *
     * @param UserRepository $usersRepository Abstraction layer between controller and database.
     *
     * @return void
     */
    public function __constrcut(UserRepository $usersRepository)
    {
        $this->middleware(['auth']);
        $this->usersRepository = $usersRepository;
    }

    /**
     * Get the index controller for the account settings.
     *
     * @todo Register route
     * @todo Write test
     * @todo Write the view.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        return view('account.settings');
    }

    /**
     * Update the account information in thje storage.
     *
     * @todo Register route
     * @todo Write phpunit test.
     * @todo Fill in the validator
     *
     * @param InformationValidator $input The given user input (Validated).
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateInformation(): RedirectResponse
    {
        //
    }

    /**
     * Update the account security in the storage.
     *
     * @todo Register route
     * @todo Write phpunit test.
     * @todo Fill in the validator
     *
     * @param SecurityValidator $input The given user input. (Validated).
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateSecurity(): RedirectResponse
    {
        //
    }
}
