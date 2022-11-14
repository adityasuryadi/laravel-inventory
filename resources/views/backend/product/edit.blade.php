@extends('layouts.app')

@section('content')
<div class="card">
{!! Form::model($product,["route"=>["product.update",$product->id],"method"=>"PUT","class"=>"form-horizontal"]) !!}
    <div class="card-header">
        <strong>{{ $title }}</strong>
    </div>
    <div class="card-body">
        @include('backend.product._form')
    </div>
    <div class="card-footer">
        <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-dot-circle-o"></i> Simpan</button>
    </div>
    {!! Form::close() !!}
</div>
@endsection