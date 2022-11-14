<!DOCTYPE html>
<html>

<head>
    <!-- <style>
        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 5px;
            text-align: left;
        }
    </style> -->
    <style>
        th {
            text-align: center
        }

        table.test {
            width: 100%;
            border-collapse: collapse;
        }

        .test th {
            text-align: center;
            border: 1px solid black;
            border-collapse: collapse;
            border-style: solid;
        }

        .test td,
        .test tr {
            border: 1px solid black;
            border-collapse: collapse;
            border-style: solid;
        }

        .page-break {
            page-break-after: always;
        }

        @font-face {
            font-family: "source_sans_proregular";
            font-weight: normal;
            font-style: normal;

        }

        body {
            font-family: Helvetica;
        }
    </style>
</head>

<body>
    <div>
        <center><b>SURAT JALAN<b></center>

        <table border="solid">
            <tr>
                <td>NO</td>
                <td>: {{ $sales->delivery_orders }}</td>
            </tr>

            <tr>
                <td>Tanggal</td>
                <td>: {{ carbon\Carbon::now()->format('d-M-Y')}}</td>
            </tr>
        </table>
        <br>
        <table style="width:100%">
            <tr>
                <td>Dari</td>
                <td>Kepada Yth</td>
            </tr>
            <tr>
                <td>
                    <strong>{{ $sales->company->name }}</strong><br>
                    {{ $sales->company->address }}<br>
                    {{ $sales->company->telp }}
                </td>
                <td>
                    <strong>{{ $sales->customer->name }}</strong><br>
                    {{ $sales->customer->address }}
                </td>
            </tr>
        </table>
        <br>
        <table class="test">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Artikel</th>
                    <th>Warna</th>
                    <th>PCS</th>
                    <th>Jumlah</th>
                    <th>Satuan</th>
                </tr>
            </thead>
            <tbody>
                @php
                $subtotal = 0;
                $no=0;
                @endphp
                @foreach($sales->detailSales as $sale)
                @php
                $subtotal += ($sale->sales_amount * $sale->sales_price);
                @endphp
                <tr>
                    <td>{{ $no += 1 }}</td>
                    <td>{{ $sale->product->article->name }}</td>
                    <td>{{ $sale->product->color }}</td>
                    <td>{{ $sale->sales_pcs }}</td>
                    <td>{{ $sale->sales_amount }}</td>
                    <td>{{ $sale->unit->value }}</td>
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3">Total</td>
                    <td>{{ $sales->pcs }}</td>
                    <td>{{ $sales->amount }}</td>
                    <td></td>
                </tr>
            </tfoot>
        </table>
        <br>
        <table style="width:100%">
            <tr>
                <td align="center">Pengirim</td>
                <td align="center">Supir</td>
                <td align="center">Penerima</td>
            </tr>
            <tr>
                <td><br></td>
                <td> </td>
                <td> </td>
            </tr>
            <tr>
                <td><br></td>
                <td> </td>
                <td> </td>
            </tr>
            <tr>
                <td align="center">(..............)</td>
                <td align="center">(..............)</td>
                <td align="center">(..............)</td>
            </tr>
        </table>

        <div class="page-break"></div>
        <center>
            <h3>PACKING LIST</h3>
        </center>
        <hr>
        <table border="solid">
            <tr>
                <td>NO</td>
                <td>: {{ $sales->delivery_orders }}</td>
            </tr>

            <tr>
                <td>Tanggal</td>
                <td>: {{ carbon\Carbon::now()->format('d-M-Y')}}</td>
            </tr>
        </table>
        <br>
        <table style="width:100%">
            <tr>
                <td>Dari</td>
                <td>Kepada Yth</td>
            </tr>
            <tr>
                <td>
                    <strong>{{ $sales->company->name }}</strong><br>
                    {{ $sales->company->address }}<br>
                    {{ $sales->company->telp }}
                </td>
                <td>
                    <strong>{{ $sales->customer->name }}</strong><br>
                    {{ $sales->customer->address }}
                </td>
            </tr>
        </table>
        <br>
        </center>
        @foreach($sales->detailSales as $sale)
        <strong>Artikel:</strong>{{ $sale->product->article->name }}<br>
        <strong>Warna:</strong>  {{ $sale->product->color }} <br>  
        <table class="test">

@foreach($sale->packing_lists as $packing_list)
                        <thead>
                            <tr>
                            @php
                            $i = 0;
                            $maxcols=10;
                            @endphp
                            <th>LOT</th>
                            @for($a=1;$a<=$maxcols;$a++) <th>{{ $a }}</th>
                                @endfor
                                <th>ROL</th>
                                <th>{{ $sale->unit->value }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                @php
                                $rowspan = count($packing_list['lots']) > $maxcols ? floor(count($packing_list['lots']) / $maxcols) + 1 : 1 ;
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
                           
                        </tbody>
                        <!-- <tfoot>
                            <td colspan="{{ $maxcols }}">Total</td>
                        </tfoot> -->
                    </table>
                    @endforeach
                    @endforeach


</body>

</html>
