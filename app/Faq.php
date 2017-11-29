<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @todo docblock
 */
class Faq extends Model
{
    /**
     * Mass-assign fields for the database column. 
     * 
     * @return array
     */
    protected $fillable = ['author_id', 'title', 'answer']; 

    /**
     * @todo docblock
     */
    public function author() 
    {
        return $this->belongsTo(User::class, 'author_id')->withDefault(['name' => 'Onbekende gebruiker']);
    }
}
