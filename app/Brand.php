<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model {

    /**
     * foreign key for product
     */
    function product() {
	return $this->hasOne(Brand::class, 'brandId');
    }

}
