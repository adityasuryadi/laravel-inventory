        <table>
        <thead>
            <tr>
                <th>No Faktur</th>
                <th>Pembeli</th>
                <th>Tanggal</th>
                <th>Warna</th>
                <th>PCS</th>
                <th>QTY</th>
                <th>Harga</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
        @php
            $row_id=0;
            $rowspan=0;
        @endphp
            @foreach($sales as $key=>$sale)
            @php
                $row_id += 1;        
                $subtotal=0;
            @endphp
                
                    @foreach($sale->detailSales as $key=>$detail)
                    <tr>
                    @php
                    $subtotal += ($detail->sales_amount * $detail->sales_price);
                    @endphp
                    @if($key == 0 || $row_id == $rowspan)
                    @php
                        $row_id = 0;
                        $rowspan = count($sale->detailSales);
                    @endphp
                    <td rowspan="{{ $rowspan }}">{{ $sale->invoice_no }}</td>
                    <td rowspan="{{ $rowspan }}">{{ $sale->customer->name }}</td>
                    <td rowspan="{{ $rowspan }}">{{ date('d-m-Y',strtotime($sale->created_at)) }}</td>
                    @endif
                        <td>{{ $detail->product->color }}</td>
                        <td>{{ $detail->sales_pcs }}</td>
                        <td>{{ $detail->sales_amount }}</td>
                        <td>{{ $detail->sales_price }}</td>
                        <td>{{ $detail->sales_price * $detail->sales_amount }}</td>
                    @endforeach
                    </tr>
            @endforeach
        </tbody>
        </table>