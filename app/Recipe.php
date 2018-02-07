<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    protected $table = 'recipes';


    public function category(){
        return $this->belongsTo('App\Category','rcp_cat_id');
    }
}
