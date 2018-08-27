<?php

namespace App;

use Auth;
use DB;
use Illuminate\Database\Eloquent\Model;

class Lists extends Model
{
    protected $table = 'lists';
    protected $primaryKey = 'id';
    public $timestamps = true;

    /**
     * relation with list_users table
     */
    public function listParticipant(){
        return $this->hasMany(ListParticipant::class,'listId');
    }
}