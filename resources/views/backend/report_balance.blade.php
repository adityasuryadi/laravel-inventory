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
    </div>
    <div id="table_report"></div>
    <div class="card-footer">
    </div>
</div>

@push('scripts')
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

    getReportBalance();

    $("#start_date,#end_date").on("change",function(){
       getReportBalance();
    });
   })

   function getReportBalance(){
        $.ajax({
            url:"{{ route('report.global') }}",
            type:'GET',
            data:{
                start_date: $("#start_date").val(),
                end_date: $("#end_date").val()
            },
            success:function(response){
                $("#table_report").html(response);
            }
        });
    }

</script>
@endpush
@endsection

