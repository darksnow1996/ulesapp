<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fee extends Model
{
    public function transaction(){
        return $this->hasOne('App\Transaction');
    }
}
