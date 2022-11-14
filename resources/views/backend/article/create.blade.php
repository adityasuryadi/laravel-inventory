@extends('layouts.app')

@section('content')
<div class="card">
{!! Form::open(["route"=>"article.store","method"=>"POST","class"=>"form-horizontal"]) !!}
    <div class="card-header">
        <strong>Data Barang</strong>
    </div>
    <div class="card-body">
        <div class="form-group row">
                <label class="col-md-3 col-form-label" for="article">Article / Code</label>
                <div class="col-md-9">
                    {!! Form::text('name',null,['class'=>'form-control']) !!}
                </div>
            </div>
    </div>
    <div class="card-footer">
        <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-dot-circle-o"></i> Simpan</button>
    </div>
    
    {!! Form::close() !!}
</div>
@endsection