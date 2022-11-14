<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SalesPayment;
use App\Models\DetailSalesPayment;
use App\Models\Sales;
use Auth;
use App\Helpers\AutoNumber;

class SalesPaymentController extends Controller
{
    public function inputPayment($id,Request $request){
        $model = SalesPayment::find($id);
        $this->validate($request,[
            'amount'=>"required|numeric|min:0|max:$model->remaining_payment"],
        [
            'amount.required'=>'harus di isi',
            'amount.min'=>'Minimal 0',
            'amount.required'=>'Maximal nominal sisa pembayaran',
        ]);
        
        $model->remaining_payment = ($model->remaining_payment) - ($request->input('amount'));
        $model->save();

        $detail = new DetailSalesPayment([
            'user_id'=>Auth::id(),
            'amount'=>$request->input('amount'),
            'note'=>$request->input('note'),
            'date'=>$request->input('date'),
        ]);

        if($model->sales->invoice_no == null){     
            $sales = Sales::findOrFail($model->sales->id);       
            $sales->invoice_no = AutoNumber::generateInvoiceNumber();
            $sales->save();
        }

        $model->detail_sales_payment()->save($detail);

        return redirect()->back();
    }
}
