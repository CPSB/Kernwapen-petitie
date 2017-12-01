<?php

namespace App\Http\Controllers;

use App\Repositories\ActivityRepository;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * ActivityController
 *
 * @package    \App\Http
 * @subpackage Controllers
 * @author     Tim Joosten <tim@activisme.be>
 */
class ActivityController extends Controller
{
    private $activityRepository; /** @var ActivityRepository $activityRepository */

    /**
     * ActivityController constructor.
     *
     * @param ActivityRepository $activityRepository
     *
     * @return void
     */
    public function __construct(ActivityRepository $activityRepository)
    {
        $this->middleware(['auth', 'role:admin']);
        $this->activityRepository = $activityRepository;
    }

    /**
     * Index page for the activity log management system.
     *
     * @todo Register route
     * @todo Write phpunit test
     * @todo Build up the view
     *
     * @param string|null $type The activity log type.
     *
     * @return \Illuminate\View\View
     */
    public function index($type = null): View
    {
        $activities = $this->activityRepository->paginate(35);

        if (is_null($type)) {
            $activities = $this->activityRepository->setLog($type)->paginate(35);
        }

        return view('activity.index', compact('activities'));
    }
}
