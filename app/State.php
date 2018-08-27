<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
     function getStates($request){
    return $this->where("countryId", $request->id)->orderBy('stateName')->get();
    }
}
