<?php

namespace App\DataTables;

use App\Models\Customer;
use Yajra\DataTables\Services\DataTable;
use Form;
use Auth;

class CustomerDataTable extends DataTable
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
        ->addColumn('action', function($query){
            $edit='<a class="btn btn-sm btn-primary" href="customer/'.$query->id.'/edit">Edit</a>';
            $delete=Form::submit('delete',['class'=>'btn btn-sm btn-danger js-submit-confirm']);
            $view='<a class="btn btn-sm btn-success" href="customer/'.$query->id.'">View</a>';
            return 
            Form::model($query, ['route' => ['customer.destroy', $query], 'method' => 'delete', 'class' => 'form-inline'] ).
            $view."&nbsp".$edit.' '.(Auth::user()->can('customer.delete') ? $delete : '').
            Form::close();
        });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Customer $model)
    {
        return $model->newQuery()->select('id', 'name', 'address', 'created_at', 'updated_at');
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
                    ->parameters($this->getBuilderParameters());
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
            'name',
            'address',
            'created_at',
            'updated_at'
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Customer_' . date('YmdHis');
    }
}
