<?php

namespace App\Http\Controllers;

use App\Repositories\CityRepository;
use App\Repositories\SignatureRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

/**
 * SignatureController
 *
 * @package    \App\Http
 * @subpackage Controllers
 * @author     Tim Joosten <tim@activisme.be>
 */
class SignatureController extends Controller
{
    private $signatureRepository; /** @var SignatureRepository $signatureRepository */

    /**
     * SignatureController constructor
     *
     * @param  SignatureRepository $signatureRepository The abstraction layer between database and controller.
     *
     * @return void
     */
    public function __construct(SignatureRepository $signatureRepository)
    {
        $this->middleware(['auth'])->except(['create']);
        $this->signatureRepository = $signatureRepository;
    }

    /**
     * Get the adminstrator index for the signatures.
     *
     * @todo Create view
     * @todo Write phpunit test
     * @todo Register route
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        return view('signatures.index', ['signatures' => $this->signatureRepository->paginate(40)]);
    }

    /**
     * Display the create form for an signature.
     *
     * @todo Connect store method to the form (view).
     * @todo Write phpunit test
     *
     * @param  CityRepository $cityRepository Abstraction layer between database and controller.
     * @return \Illuminate\View\View
     */
    public function create(CityRepository $cityRepository): View
    {
        $postal = [];

        foreach ($cityRepository->all() as $city) {
            array_push($postal, [
                'id' => $city->id, 'name' => (string) $city->postal . ' - ' . $city->name . ', ' . $city->province
            ]);
        }

        return view('signature.create', ['postal' => json_encode($postal)]);
    }

    /**
     * @todo: Implement api route. Because this is an referendum performed by a collective of organizations.
     *        So they also need an api interface to insert signatures in the database.
     */

    /**
     * Store the signature in the database.
     *
     * @todo Create the validator
     * @todo Write phpunit test (No validation errors, validation errors)
     * @todo Register routes
     *
     * @param  SignatureValidator   $input  The user given input. (Validated)
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(SignatureValidator $input): RedirectResponse
    {
        if ($signature = $this->signatureRepository->create($input->except('_token'))) {
            flash("Hartelijk bedankt, {$signature->name}! Om ons referendum te steunen.")->success();
        }

        return redirect()->route('signature.create');
    }
}
