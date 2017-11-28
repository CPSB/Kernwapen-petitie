<?php

namespace App\Http\Controllers;

use App\Http\Requests\SupportValidator;
use App\Repositories\SupportRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\View\View;

/**
 * SupportController
 *
 * @package    \App\Http
 * @subpackage Controllers
 * @author     Tim Joosten <tim@activisme.be>
 */
class SupportController extends Controller
{
    private $supportRepository;  /** @var SupportRepository $supportRepository */

    /**
     * SupportController constructor.
     *
     * @param SupportRepository $supportRepository abstraction layer bewteen database and controller
     */
    public function __construct(SupportRepository $supportRepository)
    {
        $this->middleware(['auth'])->except(['index']);
        $this->supportRepository = $supportRepository;
    }

    /**
     * Get the front-end page for the organization support.
     *
     * @todo   Write phpunit test.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        return view('support.index', ['supports' => $this->supportRepository->paginate(40)]);
    }

    /**
     * Create view for support organisation or person.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('support.create');
    }

    /**
     * Create some support organisation or person in the storage;.
     *
     * @todo    Write phpunit test.
     *
     * @param SupportValidator $support The user given input. (Validated).''
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(SupportValidator $support): RedirectResponse
    {
        return redirect()->route('support.index');
    }

    /**
     * Edit view for an organisation or person support.
     *
     * @todo Write phpunit test
     * @todo Register route
     *
     * @param int $support the unique identifier in the storage
     *
     * @return \Illuminate\View\View
     */
    public function edit($support): View
    {
        $support = $this->supportRepository->find($support) ?: abort(Response::HTTP_NOT_FOUND);

        return view('support.index', compact('support'));
    }

    /**
     * Update some organisation or person in the storage.
     *
     * @todo   Write phpunit test
     * @todo   Register route
     *
     * @param SupportValidator $input   The user given input. (validated)
     * @param int              $support The unique identifier in the storage
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(SupportValidator $input, $support): RedirectResponse
    {
        $support = $this->supportRepository->find($support) ?: abort(Response::HTTP_NOT_FOUND);

        if ($support->update($input->except('_token'))) {
            flash("{$support->name} is aangepast in het systeem.")->success();
        }

        return redirect()->route('support.index');
    }

    /**
     * Delete the support in the storage.
     *
     * @todo write phpunit test
     * @todo register route
     *
     * @param int $support the unique identifier in the storage
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($support): RedirectResponse
    {
        $support = $this->supportRepository->find($support) ?: abort(Response::HTTP_NOT_FOUND);

        if ($support->delete()) {
            flash("{$support->name} is verwijderd uit het systeem als ondersteuner.")->success();
        }

        return redirect()->route('support.index');
    }
}
