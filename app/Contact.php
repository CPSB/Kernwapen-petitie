<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @todo: docblock
 */
class Contact extends Model
{
    /** 
     * Mass-assign fields for the database table. 
     * 
     * @var array
     */
    protected $fillable = ['name', 'email', 'subject', 'message'];
}
