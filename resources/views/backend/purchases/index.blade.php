@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <strong>{{ $title }}</strong>
    </div>
    <div class="card-body">
    <div class="form-group row">
                <label class="col-md-3 col-form-label" for="article">Tanggal Awal</label>
                <div class="col-md-3">
                <input class="form-control" id="start_date" value="{{ \Carbon\Carbon::now()->startOfMonth()->format('Y-m-d') }}">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-md-3 col-form-label" for="article">Tanggal Akhir</label>
                <div class="col-md-3">
                <input class="form-control" id="end_date" value="{{ \Carbon\Carbon::now()->endOfMonth()->format('Y-m-d') }}">
                </div>
            </div>
        <a href="{{ route('purchases.create') }}" class="btn btn-sm btn-info">Tambah</a>
        {!! $dataTable->table(['class'=>'table table-striped table-bordered']) !!}
    </div>
    <div class="card-footer">
    </div>
</div>

@push('scripts')
{!! $dataTable->scripts() !!}
<script>
   $(document).ready(function(){
    var date = new Date();
    var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());
    var end = new Date(date.getFullYear(), date.getMonth(), date.getDate());
    
    $('#start_date').datepicker({
        format:"yyyy-mm-dd"
    });
    $('#end_date').datepicker({
        format:"yyyy-mm-dd"
    });

    LaravelDataTables["dataTableBuilder"].draw();

   })

   $('#start_date').on("change",function(){
        window.LaravelDataTables["dataTableBuilder"].draw();
    });

    $('#end_date').on("change",function(){
        window.LaravelDataTables["dataTableBuilder"].draw();
    });

     $('#dataTableBuilder').on('preXhr.dt', function ( e, settings, data ) {
        data.start_date= $('#start_date').val();
        data.end_date= $('#end_date').val();
    });
</script>
@endpush
@endsection

