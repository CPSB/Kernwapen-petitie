<?php 

namespace App\Repositories;

use ActivismeBE\DatabaseLayering\Repositories\Eloquent\Repository;
use App\City;

/**
 * Class CityRepository
 *
 * @package App\Repositories
 */
class CityRepository extends Repository
{
    /**
     * Set the eloquent model class for the repository.
     *
     * @return string
     */
    public function model()
    {
        return City::class;
    }
}
