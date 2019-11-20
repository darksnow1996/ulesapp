<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    public function student(){
        return $this->hasOne('App\Student');

    }
}
