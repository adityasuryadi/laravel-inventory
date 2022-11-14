@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div id="ui-view">
        <div>

@if(date('Y-m-d') == date('Y-m-t'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong><h1>AKhir Bulan,Mohon Export Stock Barang<h1></strong> 
    <button class="close" type="button" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button>
</div>
@endif

            <div class="animated fadeIn">
                <div class="row">
                    

                    <div class="col-sm-6 col-lg-3">
                        <div class="card text-white bg-info">
                            <div class="card-body pb-0">
                                <button class="btn btn-transparent p-0 float-right" type="button">
                                    <i class="icon-location-pin"></i>
                                </button>
                                <div class="text-value">{{ App\Models\Product::count() }}</div>
                                <div>Jumlah Barang</div>
                            </div>
                            <div class="chart-wrapper mt-3 mx-3" style="height:70px;">
                                <div style="position: absolute; inset: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"
                                    class="chartjs-size-monitor">
                                    <div class="chartjs-size-monitor-expand"
                                        style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                                        <div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0">
                                        </div>
                                    </div>
                                    <div class="chartjs-size-monitor-shrink"
                                        style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                                        <div style="position:absolute;width:200%;height:200%;left:0; top:0"></div>
                                    </div>
                                </div>
                                <canvas class="chart chartjs-render-monitor" id="card-chart2" height="70"
                                    style="display: block; width: 216px; height: 70px;" width="216"></canvas>
                                <div id="card-chart2-tooltip" class="chartjs-tooltip top"
                                    style="opacity: 0; left: 91.5px; top: 129.767px;">
                                    <div class="tooltip-header">
                                        <div class="tooltip-header-item">March</div>
                                    </div>
                                    <div class="tooltip-body">
                                        <div class="tooltip-body-item"><span class="tooltip-body-item-color"
                                                style="background-color: rgb(38, 203, 253);"></span><span
                                                class="tooltip-body-item-label">My First dataset</span><span
                                                class="tooltip-body-item-value">9</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-lg-3">
                        <div class="card text-white bg-warning">
                            <div class="card-body pb-0">
                                <div class="btn-group float-right">
                                    <button class="btn btn-transparent dropdown-toggle p-0" type="button"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="icon-settings"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="#">Action</a>
                                        <a class="dropdown-item" href="#">Another action</a>
                                        <a class="dropdown-item" href="#">Something else here</a>
                                    </div>
                                </div>
                                <div class="text-value">{{ App\Models\Sales::count() }}</div>
                                <div>Penjualan</div>
                            </div>
                            <div class="chart-wrapper mt-3" style="height:70px;">
                                <div style="position: absolute; inset: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"
                                    class="chartjs-size-monitor">
                                    <div class="chartjs-size-monitor-expand"
                                        style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                                        <div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0">
                                        </div>
                                    </div>
                                    <div class="chartjs-size-monitor-shrink"
                                        style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                                        <div style="position:absolute;width:200%;height:200%;left:0; top:0"></div>
                                    </div>
                                </div>
                                <canvas class="chart chartjs-render-monitor" id="card-chart3" height="70"
                                    style="display: block; width: 247px; height: 70px;" width="247"></canvas>
                                <div id="card-chart3-tooltip" class="chartjs-tooltip top bottom"
                                    style="opacity: 0; left: 248px; top: 132px;">
                                    <div class="tooltip-header">
                                        <div class="tooltip-header-item">July</div>
                                    </div>
                                    <div class="tooltip-body">
                                        <div class="tooltip-body-item"><span class="tooltip-body-item-color"
                                                style="background-color: rgba(230, 230, 230, 0.2);"></span><span
                                                class="tooltip-body-item-label">My First dataset</span><span
                                                class="tooltip-body-item-value">40</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-lg-3">
                        <div class="card text-white bg-danger">
                            <div class="card-body pb-0">
                                <div class="btn-group float-right">
                                    <button class="btn btn-transparent dropdown-toggle p-0" type="button"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="icon-settings"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="#">Action</a>
                                        <a class="dropdown-item" href="#">Another action</a>
                                        <a class="dropdown-item" href="#">Something else here</a>
                                    </div>
                                </div>
                                <div class="text-value">{{ App\Models\Purchases::count() }}</div>
                                <div>Pembelian</div>
                            </div>
                            <div class="chart-wrapper mt-3 mx-3" style="height:70px;">
                                <div style="position: absolute; inset: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"
                                    class="chartjs-size-monitor">
                                    <div class="chartjs-size-monitor-expand"
                                        style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                                        <div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0">
                                        </div>
                                    </div>
                                    <div class="chartjs-size-monitor-shrink"
                                        style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                                        <div style="position:absolute;width:200%;height:200%;left:0; top:0"></div>
                                    </div>
                                </div>
                                <canvas class="chart chartjs-render-monitor" id="card-chart4" height="70"
                                    style="display: block; width: 216px; height: 70px;" width="216"></canvas>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-5">
                                <h5 class="card-title mb-0">Report Saldo Penjualan tahun {{ date('Y') }}</h5>
                            </div>

                            <div class="col-sm-7 d-none d-md-block">
                               
                            </div>

                        </div>

                        <div style="height:400px;margin-top:40px;">
                            
                        <chart :labels="{{ json_encode($months) }}" :datasets="{{json_encode($data_balance) }}"></chart>
                           
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row text-center">
                            
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-5">
                                <h5 class="card-title mb-0">Report Pembelian dan Penjualan tahun {{ date('Y') }}</h5>
                            </div>

                            <div class="col-sm-7 d-none d-md-block">
                               
                            </div>

                        </div>
                        

                        <div style="height:400px;margin-top:40px;">
                            
                        <chart :labels="{{ json_encode($months) }}" :datasets="{{json_encode($data_chart) }}"></chart>
                           
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row text-center">
                            
                        </div>
                    </div>
                </div>

                </div>

                </div>

            </div>
        </div>
    </div>
</div>
@endsection