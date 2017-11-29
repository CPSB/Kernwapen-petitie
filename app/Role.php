<?php

namespace App;

/**
 * @todo docblock
 */
class Role extends \Spatie\Permission\Models\Role
{
    /**
     * Mass-assign fields for the database table.
     *
     * @return array
     */
    protected $fillable = ['name'];
}
