<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    //
    public function student(){
        return $this->belongsTo('App\Student');
    }
    public function fee(){
        return $this->belongsTo('App\Fee');
    }
    public function transaction_state(){
        return $this->belongsTo('App\Transaction_state');
    }
}
