<?php

namespace App\Http\Controllers;

use App\Repositories\FaqRepository;
use App\Http\Requests\FaqValidator;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\View\View;

/**
 * @todo implement docblock
 */
class FaqController extends Controller
{
    private $faqRepository; 

    public function __construct(FaqRepository $fagRepository) 
    {
        $this->middleware(['auth'])->except(['index']);
        $this->faqRepository = $faqRepository; 
    }

    public function index(): View
    {
        return view('faqs.index', ['faqs' => $this->faqRepository->paginate(20)]):
    }

    public function create(): View 
    {
        return view('faqs.create');
    }

    public function store(FaqValidator $input): RedirectResponse
    {
        if ($faq = $this->faqRepository->create($input->except('_token'))) {
            flash("{$fag->title} is opgeslagen in het systeem.")->success();
        }

        return redirect()->route('faq.index');
    }

    public function edit($item): View
    {
        $faq = $this->faqRepository->find($fag) ?: abort(Response::HTTP_NOT_FOUND);

        return view('faqs.edit', compact('faq'));
    }

    public function update(FaqValidator $input, $item): RedirectResponse 
    {

    }

    public function destroy($item): RedirectResponse
    {

    }
}
