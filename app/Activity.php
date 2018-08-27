<?php

namespace App;

use Auth;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model {

    function add($title, $description) {
        $this->userId = Auth::user()->id;
        $this->title = $title;
        $this->description = $description;
        $this->companyId = Auth::user()->companyId;
        $this->created_at = date('Y-m-d H:i:s');
        $this->save();
    }

}
