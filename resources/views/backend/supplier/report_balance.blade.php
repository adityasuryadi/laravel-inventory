<table class="table table-bordered">
            <thead><tr>
                <th>Tanggal</th>
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
                @foreach($supplier->purchases as $purchases)
                        
                       
                    @foreach($purchases->detailPurchases as $detail_purchases)
                    @php
                        $last += 1;
                        @endphp
                    <tr>
                        <td>{{ $purchases->created_at->format('d-m-Y') }}</td>
                        <td>{{ $detail_purchases->product->color }}</td>
                        <td>{{ $detail_purchases->purchase_amount }}</td>
                        <td>{{ $detail_purchases->purchase_pcs }}</td>
                        <td>{{ $detail_purchases->purchase_price }}</td>
                        <td>-</td>
                        <td>{{ NumberFormat::idrFormat($detail_purchases->purchase_amount * $detail_purchases->purchase_price) }}</td>
                        @php 
                        $saldo = $saldo + ( ($detail_purchases->purchase_amount * $detail_purchases->purchase_price)) 
                        @endphp
                        <td>{{ $purchases->total > $purchases->purchases_payment->detail_purchases_payment->sum('amount') ? "K" : "D" }}</td>
                        <td>{{ NumberFormat::idrFormat(abs($saldo)) }}</td>
                        
                        @if(count($purchases->purchases_payment->detail_purchases_payment) > 0)
                        
                        @foreach($purchases->purchases_payment->detail_purchases_payment as $detail_payment)
                        
                        @if($last == count($purchases->detailPurchases))
                        @php 
                        $saldo = $saldo -  $detail_payment->amount;
                        @endphp
                        </tr>
                            <td><strong>{{ date('d-m-Y',strtotime($detail_payment->date)) }}</strong></td>
                            <td colspan="4"><strong>{{ $detail_payment->note }}</strong></td>
                            <td><strong>{{ NumberFormat::idrFormat($detail_payment->amount) }}</strong></td>
                            <td>-</td>
                            <td><strong>{{ $purchases->total > $purchases->purchases_payment->detail_purchases_payment->sum('amount') ? "K" : "D" }}</td>
                            <td><strong>{{ NumberFormat::idrFormat($saldo) }}</strong></td>
                        </tr>
                        @endif
                        @endforeach
                        @endif
                    </tr>
                    @if($last == count($purchases->detailPurchases))
                        @php
                        $last = 0;
                        @endphp
                        @endif
                    @endforeach
                @endforeach</tbody></table>