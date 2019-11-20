<?php

namespace App\Http\Controllers;

use App\Fee;
use App\Transaction;
use Illuminate\Http\Request;
use Unicodeveloper\Paystack\Facades\Paystack;


class PaymentController extends Controller
{
    public function index(){

        $fees = Fee::all();
        return view('pay.index',compact('fees'));

    }
    public function getfee(Request $request){
        $feeid = $request->feeid;
        $fee = Fee::find($feeid);
        return response()->json(array('amount' => $fee->amount));
    }
    public function redirectToGateway()
    {
        return Paystack::getAuthorizationUrl()->redirectNow();
    }

    /**
     * Obtain Paystack payment information
     * @return void
     */
    public function handleGatewayCallback()
    {
        $paymentDetails = Paystack::getPaymentData();
        $status =  $paymentDetails['data']['status'];
        if ($status== "success"){
            $status = 1;
            $paymentdata = $paymentDetails['data'];
            $transaction = new Transaction();

              $transaction->reference = $paymentdata['reference'];
                $transaction->total_amount = $paymentdata['amount']/100;
                $transaction->ip_address = $paymentdata['ip_address'];
                $transaction->student_id = $paymentdata['metadata']['student_id'];
                $transaction->fee_id = $paymentdata['metadata']['fee_id'];
                $transaction->transaction_state_id = $status;

            $insert = $transaction->save();
            return redirect('/pay')->with('status','Payment Successful');
        }else{
            $status = 2;
            $paymentdata = $paymentDetails['data'];
            $transaction = new Transaction();

            $transaction->reference = $paymentdata['reference'];
            $transaction->total_amount = $paymentdata['amount']/100;
            $transaction->ip_address = $paymentdata['ip_address'];
            $transaction->student_id = $paymentdata['metadata']['student_id'];
            $transaction->fee_id = $paymentdata['metadata']['fee_id'];
            $transaction->transaction_state_id = $status;

            $insert = $transaction->save();
            return redirect('/pay')->with('error','Payment not Successful');
        }


        // Now you have the payment details,
        // you can store the authorization_code in your db to allow for recurrent subscriptions
        // you can then redirect or do whatever you want
    }
}
