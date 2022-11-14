@extends('layouts.app')
@push('styles')
<style>
    ul.timeline {
        list-style-type: none;
        position: relative;
    }

    ul.timeline:before {
        content: ' ';
        background: #d4d9df;
        display: inline-block;
        position: absolute;
        left: 29px;
        width: 2px;
        height: 100%;
        z-index: 400;
    }

    ul.timeline>li {
        margin: 20px 0;
        padding-left: 20px;
    }

    ul.timeline>li:before {
        content: ' ';
        background: white;
        display: inline-block;
        position: absolute;
        border-radius: 50%;
        border: 3px solid #22c0e8;
        left: 20px;
        width: 20px;
        height: 20px;
        z-index: 400;
    }
</style>
@endpush
@section('content')

<div class="container">
    <div class="card">
        <div class="card-header">
            <strong>
                @if($sales->invoice_no == null)
                <span class="badge badge-danger"> <i class="icon-close"></i> Belum di proses </a></span>
                @else
                {{ $title }}
                @endif
            </strong>


        </div>
        <div class="card-body">

            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#home3" role="tab" aria-controls="home">
                        <i class="icon-basket-loaded"></i> Detail</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#profile3" role="tab" aria-controls="profile">
                        <i class="icon-calculator"></i> Pembayaran</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#messages3" role="tab" aria-controls="messages">
                        <i class="icon-pie-chart"></i> Packing List</a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane" id="home3" role="tabpanel">

                    <strong>Invoice :</strong>{{ $sales->invoice_no}} <br>
                    <strong>Delivery Orders :</strong>{{ $sales->delivery_orders }} <br>
                    <strong>Keterangan :</strong>{{ $sales->description }}
                    <hr>
                    <div class="row mb-4">
                        <div class="col-sm-6">
                            <h6 class="mb-3">Dari:</h6>
                            <div>
                                <strong>{{ $sales->company->name }}</strong>
                            </div>
                            <div>{{ $sales->company->address }}</div>
                            <div>{{ $sales->company->telp }}</div>
                        </div>

                        <div class="col-sm-6">
                            <h6 class="mb-3">Kepada:</h6>
                            <div>
                                <strong>{{ $sales->customer->name }}</strong>
                            </div>
                            <div>{{ $sales->customer->address }}</div>
                            <div>Phone: +48 123 456 789</div>
                        </div>



                    </div>

                    <div class="table-responsive-sm">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th class="center">#</th>
                                    <th>Artikel</th>
                                    <th>Warna</th>


                                    <th class="right">Unit Cost</th>
                                    <th class="center">Jumlah</th>
                                    <th class="center">PCS</th>
                                    <th>Satuan</th>
                                    <th class="right">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $subtotal = 0;
                                @endphp
                                @foreach($sales->detailSales as $sale)
                                @php
                                $subtotal += ($sale->sales_amount * $sale->sales_price);
                                @endphp
                                <tr>
                                    <td class="center">1</td>
                                    <td class="left strong">{{ $sale->product->article->name }}</td>
                                    <td class="left">{{ $sale->product->color }}</td>

                                    <td class="right">{{ NumberFormat::idrFormat($sale->sales_price) }}</td>
                                    <td class="center">{{ $sale->sales_amount }}</td>
                                    <td class="center">{{ $sale->sales_pcs }}</td>
                                    <td>{{ $sale->unit->value }}</td>
                                    <td class="right">
                                        {{ NumberFormat::idrFormat($sale->sales_amount * $sale->sales_price) }}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-sm-5 ml-auto">
                            <table class="table table-clear">
                                <tbody>
                                    <tr>
                                        <td class="left">
                                            <strong>Subtotal</strong>
                                        </td>
                                        <td class="right">{{ NumberFormat::idrFormat($subtotal) }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-lg-12 col-sm-12 ml-auto">
                            <table class="table table-clear">
                                <tbody>
                                    <tr>
                                        <td class="left">
                                            <strong>Terbilang</strong>
                                        </td>
                                        <td class="right">{{ Nasution\Terbilang::convert( ($subtotal)) }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="btn-group" role="group" aria-label="Basic example">
                    <a type="button" class="btn btn-info" href="{{ URL::to('sales/'.$sales->id.'/suratjalan') }}"
                        target="_blank">Surat Jalan</a>
                    <a type="button" class="btn btn-info" href="{{ URL::to('sales/'.$sales->id.'/invoice') }}"
                        target="_blank">Faktur</a>
                </div>
                    </div>

                </div>
                <div class="tab-pane active" id="profile3" role="tabpanel">
                    @if(count($sales->sales_payment->detail_sales_payment) > 0)
                    <ul class="timeline">
                        @php
                        $no=0;
                        @endphp
                        @foreach($sales->sales_payment->detail_sales_payment as $detail)
                        <li>
                            <a target="_blank">Pembayaran ke {{ $no+=1 }}</a>
                            <a href="#" class="float-right">{{ date('d-M-Y',strtotime($detail->date)) }}</a>
                            <p>{{ NumberFormat::idrFormat($detail->amount) }}</p>
                            <p>{{ $detail->note }}</p>
                        </li>
                        @endforeach
                    </ul>
                    @endif

                    <div class="form-group row">
                        <label for="" class="col-md-3">Sisa Pembayaran</label>
                        <div class="col-md-6">
                            {{ NumberFormat::idrFormat($sales->sales_payment->remaining_payment) }}
                        </div>
                    </div>
                    {!! Form::open(['route'=>['input.payment',$sales->sales_payment->id],'method'=>'PUT']) !!}
                    <div class="form-group row">
                        <label for="" class="col-md-3">Jumlah Bayar</label>
                        <div class="col-md-3">
                            {{ Form::text('amount',null,['class'=>$errors->has("amount") ? "form-control is-invalid" : "form-control" ])}}
                            <div class="invalid-feedback">
                                {{ $errors->first("amount") }}
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label" for="article">Tanggal Awal</label>
                        <div class="col-md-3">
                        <input class="form-control" name="date" id="date" value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="" class="col-md-3">Keterangan</label>
                        <div class="col-md-6">
                        {{ Form::textarea('note',null,['class'=>'form-control'])}}
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
                {!! Form::close() !!}
                <div class="tab-pane" id="messages3" role="tabpanel">

@foreach($sales->detailSales as $sale)
@foreach($sale->packing_lists as $packing_list)
                    <table class="table table-bordered">
                    
<strong>Artikel:</strong>{{ $sale->product->article->name }}<br>
<strong>Warna:</strong>  {{ $sale->product->color }} <br>
                        <thead>
                            @php
                            $i = 0;
                            $maxcols=10;
                            @endphp
                            <th>LOT</th>
                            @for($a=1;$a<=$maxcols;$a++) <th>{{ $a }}</th>
                                @endfor
                                <th>ROL</th>
                                <th>{{ $sale->unit->value }}</th>
                        </thead>
                        <tbody>
                          
                            <tr>
                                @php
                                $rowspan = count($packing_list['lots'] > $maxcols) ? floor(count($packing_list['lots']) / $maxcols) + 1 : 1 ;

                                $pcs=0;
                                $qty=0;

                                $i = 0;
                                @endphp
                                <td rowspan="{{ $rowspan }}">{{ $packing_list['lot_name'] }}</td>

                                @foreach($packing_list['lots'] as $lot)
                                @if($i == $maxcols)
                                @php
                                $i=0;
                                @endphp
                            <tr>
                                @endif

                                <td>{{ $lot['lot_qty'] }}</td>
                                @php
                                $i++;
                                $pcs++;
                                $qty += (float) $lot['lot_qty'];
                                @endphp
                                @endforeach

                                @if($i < $maxcols) @for($b=$i;$b<$maxcols;$b++) <td>&nbsp;</td>
                                    @endfor
                                    @endif
                                    <td><b>{{ $pcs }}</b></td>
                                    <td><b>{{ $qty }}</b></td>
                            </tr>
                            @endforeach

                            @endforeach
                        </tbody>
                        <tfoot>
                            <td colspan="{{ $maxcols }}">Total</td>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
    $(document).ready(function(){
        var date = new Date();
        var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());
        var end = new Date(date.getFullYear(), date.getMonth(), date.getDate());
        
        $('#date').datepicker({
            format:"yyyy-mm-dd"
        });

    })

    </script>
    @endpush
    @endsection
