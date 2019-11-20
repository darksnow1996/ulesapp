<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    //

    public function transactions(){
        return $this->hasMany('App\Transaction');
    }

    public function department(){
        return $this->belongsTo('App\Department');
    }
    public function level(){
        return $this->belongsTo('App\Level');

    }

}
