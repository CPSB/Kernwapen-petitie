<?php 

namespace App\Repositories;

use ActivismeBE\DatabaseLayering\Repositories\Eloquent\Repository;
use App\Faq;

/**
 * Class FaqRepository
 *
 * @package App\Repositories
 */
class FaqRepository extends Repository
{
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
