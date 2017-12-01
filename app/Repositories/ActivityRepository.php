<?php 

namespace App\Repositories;

use App\Activity;
use ActivismeBE\DatabaseLayering\Repositories\Contracts\RepositoryInterface;
use ActivismeBE\DatabaseLayering\Repositories\Eloquent\Repository;

/**
 * Class ActivityRepository
 *
 * @package App\Repositories
 */
class ActivityRepository extends Repository
{

    /**
     * Set the eloquent model class for the repository.
     *
     * @return string
     */
    public function model()
    {
        return Activity::class;
    }
}