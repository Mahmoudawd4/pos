<?php

namespace App;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //

    use Translatable ;

    protected $guarded = [];
    public $translatedAttributes = ['name'];


    public function products()
    {
        return $this->hasMany(Product::class);

    }//end of products

    



}
