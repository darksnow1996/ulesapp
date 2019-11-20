<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction_state extends Model
{
   public function transaction(){
           return $this->hasOne('App\Transaction');
   }
}
