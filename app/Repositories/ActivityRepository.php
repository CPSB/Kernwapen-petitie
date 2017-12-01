<?php

namespace App\Repositories;

use Spatie\Activitylog\Models\Activity;
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

    /**
     * Set the log from a specific type.
     *
     * @param  string $type The log type.
     *
     * @todo implement return type.
     */
    public function setLog($type)
    {
        return $this->entity()->where('log_name', $type);
    }
}
