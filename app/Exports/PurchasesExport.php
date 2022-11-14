<?php

namespace App\Exports;

use App\Models\Purchases;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use DB;

class PurchasesExport implements FromView
{
    use Exportable;

    public function __construct(String $start_date, String $end_date)
    {
        $this->start_date = $start_date;
        $this->end_date = $end_date;
    }

    public function view(): View
    {
        return view('backend.report.purchases_report', [
            'purchases' => $purchases=Purchases::with('detailPurchases.product','supplier')->whereBetween(DB::raw('DATE(created_at)'),[$this->start_date,$this->end_date])->get()
        ]);
    }
}
