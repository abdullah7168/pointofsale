<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    public $timestamps = false;

    public function recipe()
    {
        return $this->hasMany('App\Recipe');
    }
}
