@extends('layouts.app')

@section('content')
<div class="card">
{!! Form::open(["route"=>"role.store","method"=>"POST","class"=>"form-horizontal"]) !!}
    <div class="card-header">
        <strong>{{ $title }}</strong>
    </div>
    <div class="card-body">
        <div class="form-group row">
                <label class="col-md-3 col-form-label" for="role">Nama Role</label>
                <div class="col-md-9">
                    {!! Form::text('name',null,['class'=>$errors->has("name") ? "form-control is-invalid" : "form-control" ]) !!}
                    <div class="invalid-feedback">
                        {{ $errors->first("name") }}
                    </div>
                    @foreach($permissions as $permission)
                        <input type="checkbox" name="permission[]" id="" value="{{ $permission->id }}"> {{ $permission->name }} <br>
                    @endforeach
                </div>
            </div>
    </div>
    <div class="card-footer">
        <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-dot-circle-o"></i> Simpan</button>
    </div>
    
    {!! Form::close() !!}
</div>
@endsection