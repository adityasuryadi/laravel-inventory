<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use App\Services\ProductService;
use App\Models\Sales;
use App\Services\SalesService;

class NavbarComposer
{
    /**
     * The user repository implementation.
     *
     * @var UserRepository
     */
    protected $users;

    /**
     * Create a new profile composer.
     *
     * @param  UserRepository  $users
     * @return void
     */
    // public function __construct(ProductService $product)
    // {
    //     // Dependencies automatically resolved by service container...
    //     $this->product = $product;
    // }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $total_sales = Sales::count();
        $out_process_sales = Sales::whereNull('invoice_no')->count();
        $productService = new ProductService;
        $sales_service = new SalesService;
        $view
        ->with('stock', $productService->reminderStock())
        ->with('total_sales',$total_sales)
        ->with('out_process_sales',$out_process_sales);
    }
}