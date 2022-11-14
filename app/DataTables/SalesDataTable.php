<?php

namespace App\DataTables;

use App\Models\Sales;
use Yajra\DataTables\Services\DataTable;
use App\Exports\SalesExport;
use Maatwebsite\Excel\Facades\Excel;
use DB;

class SalesDataTable extends DataTable
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
            ->editColumn('invoice_no',function($query){
                if($query->invoice_no != null){
                    $status = $query->invoice_no;
                }else{
                    $status = '<span class="badge badge-danger"> <i class="icon-close"></i> Belum di proses </a></span>';
                }
                return $status;   
            })
            ->editColumn('created_at',function($query){
                return date('d-m-Y',strtotime($query->created_at));
            })
            ->addColumn('action', function($query){
                return '<a class="btn btn-sm btn-info" href="'.route('sales.show',$query->id).'">Lihat</a>';
            })
            ->addColumn('status', function($query){
                return $query->sales_payment->remaining_payment == 0 ? 'Lunas' : 'Belum Lunas';
            })
            ->rawColumns(['status','invoice_no', 'action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Sales $model)
    {
        return $model->with('detailSales.product','customer','sales_payment')->whereBetween(DB::raw('DATE(created_at)'),[$this->request()->get('start_date'),$this->request()->get('end_date')]);
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
            'invoice_no',
            'delivery_orders',
            'status',
            'customer_id'=>['data'=>'customer.name','name'=>'customer.id'],
            'created_at'=>['title'=>'Tanggal'],
            'updated_at'=>['visible'=>false]
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Sales_' . date('YmdHis');
    }

    protected function buildExcelFile()
    {
        /** @var \Maatwebsite\Excel\Excel $excel */
        $excel = app('excel');

        return (new SalesExport($this->request()->get('start_date'),$this->request()->get('end_date')));
    }
}
