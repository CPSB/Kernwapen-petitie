<?php

namespace App;

/**
 * @todo docblock
 */
class Permission extends \Spatie\Permission\Models\Permission
{
    /**
     * Mass-assign fields for the database table.
     *
     * @return array
     */
    protected $fillable = ['name'];
}
