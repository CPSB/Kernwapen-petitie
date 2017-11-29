<?php 

namespace App\Repositories;

use App\Faq;
use ActivismeBE\DatabaseLayering\Repositories\Contracts\RepositoryInterface;
use ActivismeBE\DatabaseLayering\Repositories\Eloquent\Repository;

/**
 * Class FaqRepository
 *
 * @package App\Repositories
 */
class FaqRepository extends Repository
{§
    /**
     * Set the eloquent model class for the repository.
     *
     * @return string
     */
    public function model()
    {
        return Faq::class;
    }
}