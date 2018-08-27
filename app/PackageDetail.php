<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PackageDetail extends Model {

    /**
     * foriegn key with packages
     */
    public function package() {
        return $this->belongsTo(Package::class, 'packageId');
    }

}
