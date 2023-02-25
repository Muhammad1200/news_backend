<?php


use Illuminate\Support\Facades\Auth;

function walletChecker($amount){

    $walletAmount = floatval(Auth::user()->wallet);

    $amount = floatval($amount);

    if($walletAmount >= $amount){

        return array('wallet_amount' => $walletAmount - $amount,'stripe_amount'=>0);

    }elseif ( ( $walletAmount > 0 ) && ( $walletAmount < $amount ) ){

        return array('wallet_amount' => 0 ,'stripe_amount'=> $amount - $walletAmount);

    }else{

        return array('wallet_amount' => 0 ,'stripe_amount'=>$amount);

    }
}

function updateFromWallet($walletAmount){
    \App\Models\User::where('id',Auth::id())->update(['wallet'=>$walletAmount]);
}

?>
