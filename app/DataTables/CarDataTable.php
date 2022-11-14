<?php

namespace App\DataTables;

use App\Models\Car;
use Yajra\DataTables\Services\DataTable;

class CarDataTable extends DataTable
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
        // ->editColumn('brand_car_id',function($query){
        //     return $query->brandCar->name;
        // })
        ->rawColumns(['car_type','action'])
            ->addColumn('car_type',function($query){
                $tmp = [];
                foreach ($query->carType as $key => $value) {
                    array_push($tmp, '<li>'.$value->name.'</li>');
                };
                return '<ul>'.implode('',$tmp).'</ul>';
            })
            ->addColumn('action', '<button class="btn btn-sm btn-primary">Lihat</button> <button class="btn btn-sm btn-danger">Hapus</button>');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Car $model)
    {
        return $model->with(['brandCar','carType'])->select('*');
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
            'brand_car_id'=>['data'=>'brand_car.name','name'=>'brand_car_id','title'=>'Merk'],
            'name'=>['title'=>'Nama Mobil'],
            'year'=>['title'=>'Tahun'],
            'car_type'=>['title'=>'Jenis Mobil'],
        ];
    }

    protected function rawColumns()
    {
        return [
            'car_type'
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Car_' . date('YmdHis');
    }
}
