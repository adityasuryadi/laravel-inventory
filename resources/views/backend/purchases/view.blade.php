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
            <strong>{{ $title }}</strong>
            <span class="float-right"> <strong>Status:</strong> Pending</span>

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
            </ul>

            <div class="tab-content">
                <div class="tab-pane active" id="profile3" role="tabpanel">
                    @if(count($purchases->purchases_payment->detail_purchases_payment) > 0)
                    <ul class="timeline">
                        @php
                        $no=0;
                        @endphp
                        @foreach($purchases->purchases_payment->detail_purchases_payment as $detail)
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
                            {{ NumberFormat::idrFormat($purchases->purchases_payment->remaining_payment) }}
                        </div>
                    </div>
                    {!! Form::open(['route'=>['purchases.payment',$purchases->purchases_payment->id],'method'=>'PUT']) !!}
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
                            <input class="form-control" name="date" id="date"
                                value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
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

                <div class="tab-pane" id="home3" role="tabpanel">


                    <div class="col-sm-6">
                        <h6 class="mb-3">Dari:</h6>
                        <div>
                            <strong>{{ $purchases->supplier->name }}</strong>
                        </div>
                        <div>{{ $purchases->supplier->address }}</div>
                        <div>Phone: +48 123 456 789</div>
                    </div>

                    <div class="table-responsive-sm">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th class="center">#</th>
                                    <th>Artikel</th>
                                    <th>Warna</th>
                                    <th class="center">Jumlah</th>
                                    <th class="center">PCS</th>
                                    <th>Satuan</th>
                                    <th>Harga</th>
                                    <th>Sub Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $total=0;
                                @endphp
                                @foreach($purchases->detailPurchases as $detail)
                                @php
                                $total += ($detail->purchase_price * $detail->purchase_amount);
                                @endphp
                                <tr>
                                    <td class="center">1</td>
                                    <td class="left strong">{{ $detail->product->article->name }}</td>
                                    <td class="left">{{ $detail->product->color }}</td>
                                    <td class="center">{{ $detail->purchase_amount }}</td>
                                    <td class="center">{{ $detail->purchase_pcs }}</td>
                                    <td>{{ $detail->unit->value }}</td>
                                    <td>{{ NumberFormat::idrFormat($detail->purchase_price) }}</td>
                                    <td>{{ NumberFormat::idrFormat(($detail->purchase_price) * ($detail->purchase_amount)) }}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        
                    <div class="col-lg-12 col-sm-12 ml-auto">
                        <table class="table table-clear">
                            <tbody>
                                <tr>
                                    <td class="left">
                                        <strong>Terbilang</strong>
                                    </td>
                                    <td class="right">{{ Nasution\Terbilang::convert( ($total)) }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="row">
                    <div class="col-lg-4 col-sm-5">

                    </div>

                    <div class="col-lg-4 col-sm-5 ml-auto">
                        <table class="table table-clear">
                            <tbody>
                                <tr>
                                    <td class="left">
                                        <strong>Total</strong>
                                    </td>
                                    <td class="right">
                                        <strong>{{ NumberFormat::idrFormat($total) }}</strong>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                    </div>
                    </div>
                </div>
                

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
