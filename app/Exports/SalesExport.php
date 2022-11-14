<?php

namespace App\Exports;

use App\Models\Sales;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use DB;

class SalesExport implements FromView
{
    use Exportable;

    public function __construct(String $start_date, String $end_date)
    {
        $this->start_date = $start_date;
        $this->end_date = $end_date;
    }

    public function view(): View
    {
        return view('backend.report.sales_report', [
            'sales' => $sales=Sales::with('detailSales.product','customer')->whereBetween(DB::raw('DATE(created_at)'),[$this->start_date,$this->end_date])->get()
        ]);
    }
}
