<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;

class AccountSettingsController extends Controller
{
    /**
     * Account SettingsController
     *
     * @return void
     */
    public function __constrcut()
    {
        $this->middleware(['auth']);
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
