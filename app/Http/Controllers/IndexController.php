<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

/**
 * @todo Implement docblock
 */
class IndexController extends Controller
{
    /**
     * Get the application front-page.
     *
     * @return View
     */
    public function index(): View
    {
        return view('welcome');
    }
}
