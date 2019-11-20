<?php

namespace App\Http\Controllers;

use App\Student;
use App\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    //

    public function showtransactions(){
        $transactions = Student::find(Auth::user()->id);
       return view('transaction.list',compact('transactions'));



}

}
