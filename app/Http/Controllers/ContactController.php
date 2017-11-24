<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactValidator;
use App\Repositories\ContactRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ContactController extends Controller
{
    private $contactRepository;

    public function __construct(ContactRepository $contactRepository)
    {
        $this->contactRepository = $contactRepository;
    }

    public function index(): View
    {
        return view('contact.index');
    }

    public function store(ContactValidator $input): RedirectResponse
    {
        if ($this->contactRepository->create($input->except(['_token']))) {
            flash("Je bericht is verzonden. Wij zullen snel je bericht bekijken en antwoorden indien nodig.")->success();
        }

        return redirect()->route('contact.index');
    }
}
