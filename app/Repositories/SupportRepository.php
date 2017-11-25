<?php

namespace App\Repositories;

use ActivismeBE\DatabaseLayering\Repositories\Eloquent\Repository;
use Supportspace\Support;

/**
 * Class SupportRepository.
 */
class SupportRepository extends Repository
{
    /**
     * Set the eloquent model class for the repository.
     *
     * @return string
     */
    public function model()
    {
        return Support::class;
    }
}
