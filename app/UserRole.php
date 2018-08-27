<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserRole extends Model {

    //
    /**
     * foriegn key with users
     */
    public function user() {
        return $this->belongsTo(User::class, 'userId');
        
    }

}
