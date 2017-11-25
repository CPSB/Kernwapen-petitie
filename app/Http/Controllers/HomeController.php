<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

/**
 * HomeController
 *
 * @package    \App\Http
 * @subpackage Controllers
 * @author     Tim Joosten <tim@activisme.be>
 */
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @todo write phpunit test.
     * 
     * @return \Illuminate\View\View;
     */
    public function index(): View
    {
        return view('home');
    }
}
