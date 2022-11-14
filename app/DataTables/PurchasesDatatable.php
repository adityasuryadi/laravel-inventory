<?php

namespace App\DataTables;

use App\Models\Purchases;
use Yajra\DataTables\Services\DataTable;
use App\Exports\PurchasesExport;
use DB;

class PurchasesDatatable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables($query)
            ->editColumn('created_at',function($query){
                return date('d-m-Y',strtotime($query->created_at));
            })
            ->addColumn('status', function($query){
                return $query->purchases_payment->remaining_payment == 0 ? 'Lunas' : 'Belum Lunas';
            })
            ->addColumn('action', function($query){
                return '<a class="btn btn-sm btn-info" href="'.route('purchases.show',$query->id).'">Lihat</a>';
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Purchases $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Purchases $model)
    {
        return $model->with('supplier')->whereBetween(DB::raw('DATE(created_at)'),[$this->request()->get('start_date'),$this->request()->get('end_date')])->orderBy('created_at','desc')->get();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->addAction(['width' => '80px'])
                    ->parameters([
                        'dom'          => 'Bfrtip',
                        'buttons'      => ['excel','reset'],
                    ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            'id'=>['visible'=>false],
            'supplier_id'=>['data'=>'supplier.name','name'=>'supplier.name'],
            'pcs',
            'amount',
            'status',
            'created_at'
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Purchase_' . date('YmdHis');
    }

    protected function buildExcelFile()
    {
        /** @var \Maatwebsite\Excel\Excel $excel */
        $excel = app('excel');

        return (new PurchasesExport($this->request()->get('start_date'),$this->request()->get('end_date')));
    }
}
