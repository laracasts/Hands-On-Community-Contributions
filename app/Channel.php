<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    /**
     * The fillable fields for the table.
     *
     * @var array
     */
    protected $fillable = ['title', 'slug', 'color'];

    /**
     * Get the key to use for implicit route binding.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
