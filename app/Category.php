<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
     /**
     * foreign key for product
     */
    function productCategory() {
	return $this->hasMany(Category::class, 'categoryId');
    }

}
