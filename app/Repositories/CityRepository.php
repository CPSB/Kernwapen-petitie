<?php 

namespace App\Repositories;

use ActivismeBE\DatabaseLayering\Repositories\Eloquent\Repository;
use App\City;
use Illuminate\Pagination\LengthAwarePaginator;

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

    /**
     * Search for a specific city in the storage.
     *
     * @param mixed $term       The given user search term.
     * @param int   $perPage    The result u want to display per page.
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function searchCityMontitor($term, $perPage): LengthAwarePaginator
    {
        // Multiple where statement gives in a strange way errors on PSQL.
        // Need to look after it in a later release.

        return $this->entity()->where('name', 'LIKE', "%{$term}%")->paginate($perPage);
    }
}
