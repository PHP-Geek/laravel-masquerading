<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model {

    protected $table = 'product_categories';

    function category() {
	return $this->belongsTo(Category::class, 'categoryId');
    }

    function product() {
	return $this->belongsTo(Product::class, 'productId');
    }

}
