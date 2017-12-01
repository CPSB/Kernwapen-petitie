<?php

namespace App\Http\Controllers;

use App\Repositories\ActivityRepository;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    private $activityRepository;

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
}
