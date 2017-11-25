<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

/**
 * IndexController
 *
 * @package    \App\Http
 * @subpackage Controllers
 * @author     Tim Joosten <tim@activisme.be>
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
