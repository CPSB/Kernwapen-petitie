<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

/**
 * Class DisclaimerController.
 */
class DisclaimerController extends Controller
{
    /**
     * Display the disclaimer controller for the application.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        return view('disclaimer.index');
    }
}
