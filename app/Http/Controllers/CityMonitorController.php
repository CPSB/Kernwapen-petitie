<?php

namespace App\Http\Controllers;

use App\Repositories\CityRepository;
use Illuminate\View\View;

/**
 * CityMonitorController
 *
 * @package    \App\Http
 * @subpackage Controllers
 * @author     Tim Joosten <tim@activisme.be>
 */
class CityMonitorController extends Controller
{
    private $cityRepository; /** @var CityRepository $cityRepository */

    /**
     * CityMonitorController constructor.
     *
     * @param CityRepository $cityRepository The abstraction layer between controller and database.
     *
     * @return void
     */
    public function __construct(CityRepository $cityRepository)
    {
        $this->middleware(['auth']);
        $this->cityRepository = $cityRepository;
    }

    /**
     * Get the index page for the city monitor.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        return view('city-monitor.index', ['cities' => $this->cityRepository->paginate(50)]);
    }
}
