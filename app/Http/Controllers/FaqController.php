<?php

namespace App\Http\Controllers;

use App\Http\Requests\FaqValidator;
use App\Repositories\FaqRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\View\View;

/**
 * FaqController
 *
 * @package    \App\Http
 * @subpackage Controllers
 * @author     Tim Joosten <tim@activisme.be>
 */
class FaqController extends Controller
{
    private $faqRepository; /** @var FaqRepository $faqRepository */

    /**
     * FaqController constructor
     *
     * @todo Register the language middleware. (Index)
     * @todo Register the correct acl middleware.
     *
     * @param FaqRepository $faqRepository The abstraction layer between database and controller.
     *
     * @return void
     */
    public function __construct(FaqRepository $faqRepository)
    {
        $this->middleware(['auth'])->except(['index']);
        $this->faqRepository = $faqRepository;
    }

    /**
     * [FRONT-END]: The index page for the fag points.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        return view('faqs.index', ['faqs' => $this->faqRepository->paginate(20)]);
    }

    /**
     * The create view for an new faq item.
     *
     * @todo wrtie phpunit test
     * @todo register the route.
     *
     * @return \Illuminate\View\View
     */
    public function create(): View
    {
        return view('faqs.create');
    }

    /**
     * Store a new faq item in the storage.
     *
     * @todo register the validator
     * @todo write phpunit test
     * @todo register the route
     *
     * @param FaqValidator $input The given user input instance. (Validated)
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(FaqValidator $input): RedirectResponse
    {
        $input->merge(['author_id' => auth()->user()->id]);

        if ($faq = $this->faqRepository->create($input->except('_token'))) {
            flash("{$faq->title} is opgeslagen in het systeem.")->success();
        }

        return redirect()->route('faq.index');
    }

    /**
     * Edit view for an faq item.
     *
     * @todo build up the view
     * @todo register the route
     * @todo write phpunit test
     *
     * @param int $item The unique identifier in the storage.
     *
     * @return \Illuminate\View\View
     */
    public function edit($item): View
    {
        $faq = $this->faqRepository->find($item) ?: abort(Response::HTTP_NOT_FOUND);

        return view('faqs.edit', compact('faq'));
    }

    /**
     * Update an faq item in the system.
     *
     * @todo build up the validator
     * @todo register route
     * @todo write phpunit test
     *
     * @param FaqValidator  $input  The user given input (validated).
     * @param int           $item   The unique identifier in the storage
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(FaqValidator $input, $item): RedirectResponse
    {
        $faq = $this->faqRepository->find($item) ?: abort(Response::HTTP_NOT_FOUND);

        if ($faq->update($input->except('_token'))) {
            flash("{$faq->title} is aangepast in het systeem.");
        }

        return redirect()->route('faq.index');
    }

    /**
     * Delete a faq item out of the storage.
     *
     * @todo register route
     * @todo build up the phpunit test
     *
     * @param int $item The unique identifier in the storage
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($item): RedirectResponse
    {
        $faq = $this->faqRepository->find($item) ?: abort(Response::HTTP_NOT_FOUND);

        if ($item = $faq->delete()) {
            flash("{$item->title} is verwijderd uit het systeem.")->success();
        }

        return redirect()->response('faq.index');
    }
}
