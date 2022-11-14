<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ProductExport implements FromQuery, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */

    use Exportable;

    public function headings(): array
    {
        return [
            'Artikel',
            'Warna',
            'PCS',
            'QTY',
            'Harga Pokok',
            'Harga Jual',
            'Total'
        ];
    }

    public function query()
    {
        return Product::query()->with('article')->select('*');
    }

    public function map($product): array
    {
        return [
            $product->article->name,
            $product->color,
            $product->pcs,
            $product->amount,
            $product->principal_price,
            $product->price,
            ($product->price * $product->amount)
        ];
    }

    public static function afterSheet(AfterSheet $event){
        $event->sheet->appendRows(array(
            array('test1', 'test2'),
            array('test3', 'test4'),
            //....
        ), $event);
    }
}
