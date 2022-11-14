<table class="table table-bordered">
            <thead><tr>
                <th>Tanggal</th>
                <th>No Faktur</th>
                <th>Keterangan</th>
                <th>Barang</th>
                <th>QTY</th>
                <th>PCS</th>
                <th>Harga</th>
                <th>Debit</th>
                <th>Kredit</th>
                <th>D/K</th>
                <th>Saldo</th></tr></thead>
                <tbody>
                @php
                        $last=0;
                        $saldo=0;
                    @endphp
                @foreach($customer->sales as $sales)
                        
                       
                    @foreach($sales->detailSales as $detail_sales)
                    @php
                        $last += 1;
                        @endphp
                    <tr>
                        <td>{{ $sales->created_at->format('d-m-Y') }}</td>
                        <td>{{ $detail_sales->sales->invoice_no }}</td>
                        <td>{{ $detail_sales->sales->description }}</td>
                        <td>{{ $detail_sales->product->color }}</td>
                        <td>{{ $detail_sales->sales_amount }}</td>
                        <td>{{ $detail_sales->sales_pcs }}</td>
                        <td>{{ NumberFormat::idrFormat($detail_sales->sales_price) }}</td>
                        <td>-</td>
                        <td>{{ NumberFormat::idrFormat($detail_sales->sales_amount * $detail_sales->sales_price) }}</td>
                        @php 
                        $saldo = $saldo + ( ($detail_sales->sales_amount * $detail_sales->sales_price)) 
                        @endphp
                        <td>{{ $sales->total > $sales->sales_payment->detail_sales_payment->sum('amount') ? "K" : "D" }}</td>
                        <td>{{ NumberFormat::idrFormat(abs($saldo)) }}</td>
                        
                        @if(count($sales->sales_payment->detail_sales_payment) > 0)
                        
                        @foreach($sales->sales_payment->detail_sales_payment as $detail_payment)
                        
                        @if($last == count($sales->detailSales))
                        @php 
                        $saldo = $saldo -  $detail_payment->amount;
                        @endphp
                        </tr>
                            <td><strong>{{ date('d-m-Y',strtotime($detail_payment->date)) }}</strong></td>
                            <td colspan="6"><strong>{{ $detail_payment->note }}</strong></td>
                            <td><strong>{{ NumberFormat::idrFormat($detail_payment->amount) }}</strong></td>
                            <td>-</td>
                            <td><strong>{{ $sales->total > $sales->sales_payment->detail_sales_payment->sum('amount') ? "K" : "D" }}</td>
                            <td><strong>{{ NumberFormat::idrFormat($saldo) }}</strong></td>
                        </tr>
                        @endif
                        @endforeach
                        @endif
                    </tr>
                    @if($last == count($sales->detailSales))
                        @php
                        $last = 0;
                        @endphp
                        @endif
                    @endforeach
                @endforeach</tbody></table>