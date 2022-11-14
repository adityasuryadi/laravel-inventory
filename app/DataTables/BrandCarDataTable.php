<?php

namespace App\DataTables;

use App\Models\BrandCar;
use Yajra\DataTables\Services\DataTable;
use Form;

class BrandCarDataTable extends DataTable
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
            $edit='<a class="btn btn-sm btn-primary" href="carbrands/'.$query->id.'/edit">Edit</a>';
            $delete=Form::submit('delete',['class'=>'btn btn-sm btn-danger js-submit-confirm']);
            return 
            Form::model($query, ['route' => ['carbrands.destroy', $query], 'method' => 'delete', 'class' => 'form-inline'] ).
            $edit.' '.$delete.
            Form::close();
        });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\BrandCar $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(BrandCar $model)
    {
        return $model->newQuery()->select('id', 'name');
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
            'name',
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'BrandCar_' . date('YmdHis');
    }
}
