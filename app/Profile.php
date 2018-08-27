<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model {

    /**
     * foreign key for user
     * @return type
     */
    public function user() {
        return $this->belongsTo(User::class, 'userId');
    }

}
