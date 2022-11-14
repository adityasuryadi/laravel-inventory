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
            border-style: dotted;
        }

        .test td,
        .test tr {
            border: 1px solid black;
            border-collapse: collapse;
            border-style: dotted;
        }

        @font-face {
            font-family: Calibri;
            /* src: local("Courier New"), url("fonts/sourcesans/sourcesanspro-regular-webfont.ttf") format("truetype"); */
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
        <center><b>FAKTUR<b></center><br>
        <table>
            <tr>
                <td>No Faktur </td>
                <td>: {{ $sales->invoice_no }}</td>
            </tr>
            <tr>
                <td>Tanggal</td>
                <td>: {{ $sales->updated_at->format('d-M-Y') }}</td>
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
                    <strong>{{ $sales->company->name }}</strong>

                </td>
                <td><strong>{{ $sales->customer->name }}</strong></td>
            <tr>
                <td>
                    {{ $sales->company->address }}
                </td>
                <td>
                    {{ $sales->customer->address }}</td>
            </tr>
            <tr>
                <td>
                    {{ $sales->company->telp }}</td>
                <td>
            </tr>
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


                    <th>Harga</th>

                    <th>Jumlah</th>

                    <th>Satuan</th>
                    <th>PCS</th>
                    <th>Total</th>
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
                    <td>{{ $no+=1 }}</td>
                    <td>{{ $sale->product->article->name }}</td>
                    <td>{{ $sale->product->color }}</td>

                    <td>{{ NumberFormat::idrFormat($sale->sales_price) }}</td>
                    <td>{{ $sale->sales_amount }}</td>
                    <td>{{ $sale->unit->value }}</td>
                    <td>{{ $sale->sales_pcs }}</td>
                    <td>{{ NumberFormat::idrFormat($sale->sales_amount * $sale->sales_price) }}
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4" align="center"><b>Total</b></td>

                    <td>{{ $sales->amount }}</td>
                    <td></td>
                    <td>{{ $sales->pcs }}</td>
                    <td>{{ NumberFormat::idrFormat($sales->total) }}</td>
                </tr>
            </tfoot>
        </table>
        <br>
        <br>
        <table style="width:100%">
            <tr>
                <td align="center">Hormat Kami</td>
                <td align="center">Penerima</td>
            </tr>
            <tr>
                <td><br><br><br></td>
                <td></td>
            </tr>
            <tr>
                <td align="center">(..............)</td>
                <td align="center">(..............)</td>
            </tr>
        </table>


</body>

</html>
