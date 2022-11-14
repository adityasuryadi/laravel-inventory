<table>
        <thead>
            <tr>
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
            @foreach($purchases as $key=>$purchase)
            @php
                $row_id += 1;        
                $subtotal=0;
            @endphp
                
                    @foreach($purchase->detailPurchases as $key=>$detail)
                    <tr>
                    @php
                    $subtotal += ($detail->purchase_amount * $detail->purchase_price);
                    @endphp
                    @if($key == 0 || $row_id == $rowspan)
                    @php
                        $row_id = 0;
                        $rowspan = count($purchase->detailPurchases);
                    @endphp
                    <td rowspan="{{ $rowspan }}">{{ $purchase->supplier->name }}</td>
                    <td rowspan="{{ $rowspan }}">{{ date('d-m-Y',strtotime($purchase->created_at)) }}</td>
                    @endif
                        <td>{{ $detail->product->color }}</td>
                        <td>{{ $detail->purchase_pcs }}</td>
                        <td>{{ $detail->purchase_amount }}</td>
                        <td>{{ $detail->purchase_price }}</td>
                        <td>{{ $detail->purchase_price * $detail->purchase_amount }}</td>
                    @endforeach
                    </tr>
                    <tr>
                        <td>Sub Total</td>
                        <td colspan="6">{{ $subtotal }}</td>
                    </tr>
            @endforeach
        </tbody>
        </table>