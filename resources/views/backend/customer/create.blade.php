@extends('layouts.app')

@section('content')
<div class="card">
{!! Form::open(["route"=>"customer.store","method"=>"POST","class"=>"form-horizontal"]) !!}
    <div class="card-header">
        <strong>Data Barang</strong>
    </div>
    <div class="card-body">
        @include('backend.customer._form')
    </div>
    <div class="card-footer">
        <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-dot-circle-o"></i> Simpan</button>
    </div>
    
    {!! Form::close() !!}
</div>
@endsection