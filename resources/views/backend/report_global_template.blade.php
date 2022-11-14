    <div class="form-row">
    @php
                    $x= 1;
                    $y=1;
                    $total_piutang=0;
                    $total_hutang=0;
                    @endphp
    <div class="col-md-1"></div>
        <div class="col-md-5">
        <center>PIUTANG GLOBAL {{ $start_date }} sampai  {{ $end_date }}</center>
            <table class="table table-bordered">
                <thead>
                    <th>No</th>
                    <th>Pembeli</th>
                    <th>Kredit</th>
                    <th>Debit</th>
                    <th>Saldo</th>
                </thead>
                <tbody>
                    @foreach($customers as $customer )
                    <tr>
                        <td>{{ $x++ }}</td>
                        <td>{{ $customer->name }}</td>
                        <td>{{ NumberFormat::idrFormat($customer->kredit) }}</td>
                        <td>{{ NumberFormat::idrFormat($customer->debet) }}</td>
                        <td>{{ NumberFormat::idrFormat($customer->kredit - $customer->debet) }}</td>
                        @php
                        $total_piutang+=($customer->kredit-$customer->debet)
                        @endphp
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                <tr>
                <td colspan="4">Total</td>
                <td>{{ NumberFormat::idrFormat($total_piutang) }}</td></tr></tfoot>
            </table>
        </div>
        <div class="col-md-5">
        <center>HUTANG GLOBAL {{ $start_date }} sampai  {{ $end_date }}</center>
            <table class="table table-bordered">
                <thead>
                    <th>No</th>
                    <th>Penjual</th>
                    <th>Kredit</th>
                    <th>Debit</th>
                    <th>Saldo</th>
                </thead>
                <tbody>
                    @foreach($suppliers as $supplier )
                    <tr>
                        <td>{{ $y++ }}</td>
                        <td>{{ $supplier->name }}</td>
                        <td>{{ NumberFormat::idrFormat($supplier->kredit) }}</td>
                        <td>{{ NumberFormat::idrFormat($supplier->debet) }}</td>
                        <td>{{ NumberFormat::idrFormat($supplier->kredit-$supplier->debet) }}</td>
                    </tr>
                    @php
                        $total_hutang+=($supplier->kredit - $supplier->debet)
                        @endphp
                    @endforeach
                </tbody>
                <tfoot>
                <tr>
                <td colspan="4">Total</td>
                <td>{{ NumberFormat::idrFormat($total_hutang) }}</td></tr></tfoot>
            </table>
        </div>
        
        <div class="col-md-1"></div>
    </div>
