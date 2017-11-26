<?php

namespace App\Http\Controllers;

use App\Http\Requests\InformationValidator;
use App\Http\Requests\SecurityValidator;
use App\Repositories\UsersRepository;
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
    private $usersRepository; /** @var UsersRepository $usersRepository */

    /**
     * Account SettingsController
     *
     * @param UsersRepository $usersRepository Abstraction layer between controller and database.
     *
     * @return void
     */
    public function __construct(UsersRepository $usersRepository)
    {
        $this->middleware(['auth']);
        $this->usersRepository = $usersRepository;
    }

    /**
     * Get the index controller for the account settings.
     *
     * @todo Write the view.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        return view('auth.settings', [
            'user' => $this->usersRepository->find(auth()->user()->id, ['name', 'email'])
        ]);
    }

    /**
     * Update the account information in the storage.
     *
     * @param InformationValidator $input The given user input (Validated).
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateInformation(InformationValidator $input): RedirectResponse
    {
        if ($this->usersRepository->update($input->except('_token'), auth()->user()->id)) {
            flash("Uw account informatie is aangepast.")->success();
        }

        return redirect()->route('account.settings', ['type' => 'information']);
    }

    /**
     * Update the account security in the storage.
     *
     * @param SecurityValidator $input The given user input. (Validated).
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateSecurity(SecurityValidator $input): RedirectResponse
    {
        $password = bcrypt($input->password);

        if ($this->usersRepository->update(['password' => $password], auth()->user()->id)) {
            flash('Uw account beveiliging is aangepast.')->success();
        }

        return redirect()->route('account.settings', ['type' => 'security']);
    }
}
