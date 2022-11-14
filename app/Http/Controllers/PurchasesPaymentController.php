<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetailPurchasesPayment;
use App\Models\PurchasesPayment;
use Auth;

class PurchasesPaymentController extends Controller
{
    public function inputPayment($id,Request $request){
        $model = PurchasesPayment::find($id);
        $this->validate($request,[
            'amount'=>"required|numeric|min:0|max:$model->remaining_payment"],
        [
            'amount.required'=>'harus di isi',
            'amount.min'=>'Minimal 0',
            'amount.required'=>'Maximal nominal sisa pembayaran',
        ]);
        
        $model->remaining_payment = ($model->remaining_payment) - ($request->input('amount'));
        $model->save();

        $detail = new DetailPurchasesPayment([
            'user_id'=>Auth::id(),
            'amount'=>$request->input('amount'),
            'note'=>$request->input('note'),
            'date'=>$request->input('date'),
        ]);

        $model->detail_purchases_payment()->save($detail);

        return redirect()->back();
    }
}
