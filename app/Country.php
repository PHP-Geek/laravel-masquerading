<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    function getCountries(){
    return $this->where('countryStatus', '1')->get();
    }
}
