<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactValidator;
use App\Repositories\ContactRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

/**
 * @todo docblock
 */
class ContactController extends Controller
{
    private $contactRepository; /** @var ContactRepository $contactRepository */

    /**
     * ContactController constructor.
     *
     * @param ContactRepository $contactRepository the abstraction layer between database model and controller
     */
    public function __construct(ContactRepository $contactRepository)
    {
        $this->contactRepository = $contactRepository;
    }

    /**
     * Get the conjtact page in the front-end.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        return view('contact.index');
    }

    /**
     * Store the contact form in the database for the admins.
     *
     * @todo: Implement phpunit test.
     *
     * @param ContactValidator $input The user given input. (validated)
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ContactValidator $input): RedirectResponse
    {
        if ($this->contactRepository->create($input->except(['_token']))) {
            flash('Je bericht is verzonden. Wij zullen snel je bericht bekijken en antwoorden indien nodig.')->success();
        }

        return redirect()->route('contact.index');
    }
}
