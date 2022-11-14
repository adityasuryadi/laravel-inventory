@extends('layouts.app')

@section('content')
<div class="card">
{!! Form::open(["route"=>"sysvalue.store","method"=>"POST","class"=>"form-horizontal"]) !!}
    <div class="card-header">
        <strong>{{ $title }}</strong>
    </div>
    <div class="card-body">
        @include('backend.sys_value._form')
    </div>
    <div class="card-footer">
        <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-dot-circle-o"></i> Simpan</button>
    </div>
    {!! Form::close() !!}
</div>
@endsection