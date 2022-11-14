<?php

namespace App\DataTables;

use App\Models\Product;
use App\Helpers\NumberFormat;
use Yajra\DataTables\Services\DataTable;
use App\Exports\ProductExport;
use Maatwebsite\Excel\Facades\Excel;
use Form;

class ProductDataTable extends DataTable
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
            ->editColumn('price',function($query){
                return NumberFormat::idrFormat($query->price);
            })
            ->editColumn('principal_price',function($query){
                return NumberFormat::idrFormat($query->principal_price);
            })
            ->addColumn('amount',function($query){
                return number_format($query->amount,2,",",".");
            })
            ->addColumn('price_meter',function($query){
                return NumberFormat::idrFormat($query->price / 0.9144);
            })
            ->addColumn('action', function($query){
                $edit='<a class="btn btn-sm btn-primary" href="product/'.$query->id.'/edit">Edit</a>';
                $delete=Form::submit('delete',['class'=>'btn btn-sm btn-danger js-submit-confirm']);
                return 
                Form::model($query, ['route' => ['product.destroy', $query], 'method' => 'delete', 'class' => 'form-inline'] ).
                $edit.' '.$delete.
                Form::close();
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Product $model)
    {
        return $model->with('article','unit')->select('products.*');
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
                    ->addAction(['width' => '150px'])
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
    protected function getBuilderParameters(){
        return [
            'buttons'=>['export']
        ];
    }

    protected function getColumns()
    {
        return [
            [
                "data" => "article.name",
                "name" => "article.name",
                "title" => "Artikel",
            ],
            'pcs',
            'amount'=>['title'=>'QTY'],
            'color'=>['title'=>'Warna'],
            'principal_price'=>['title'=>'Harga Pokok','visible'=>false],
            'price'=>['title'=>'Harga'],
            'unit_id'=>['title'=>'Satuan','data'=>'unit.value','name'=>'unit.value']
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Product_' . date('YmdHis');
    }

    protected function buildExcelFile()
    {
        /** @var \Maatwebsite\Excel\Excel $excel */
        $excel = app('excel');

        return (new ProductExport);
    }
}
