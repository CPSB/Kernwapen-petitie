<?php 

namespace App\Repositories;

use ActivismeBE\DatabaseLayering\Repositories\Eloquent\Repository;
use App\User;

/**
 * Class UserRepository
 *
 * @package App\Repositories
 */
class UserRepository extends Repository
{
    /**
     * Set the eloquent model class for the repository.
     *
     * @return string
     */
    public function model()
    {
        return User::class;
    }
}
