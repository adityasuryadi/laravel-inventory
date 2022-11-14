
<div class="form-group row">
    <label class="col-md-3 col-form-label" for="role">Nama</label>
    <div class="col-md-9">
        {!! Form::text('name',null,['class'=>$errors->has("name") ? "form-control is-invalid" : "form-control" ]) !!}
        <div class="invalid-feedback">
            {{ $errors->first("name") }}
        </div>
    </div>
</div>

<div class="form-group row">
    <label class="col-md-3 col-form-label" for="role">User Name</label>
    <div class="col-md-9">
        {!! Form::text('user_name',null,['class'=>$errors->has("name") ? "form-control is-invalid" : "form-control" ])
        !!}
        <div class="invalid-feedback">
            {{ $errors->first("user_name") }}
        </div>
    </div>
</div>

<div class="form-group row">
    <label class="col-md-3 col-form-label" for="role">Password</label>
    <div class="col-md-9">
        {!! Form::password('password',['class'=>$errors->has("password") ? "form-control is-invalid" : "form-control" ])
        !!}
        <div class="invalid-feedback">
            {{ $errors->first("password") }}
        </div>
    </div>
</div>

<div class="form-group row">
    <label class="col-md-3 col-form-label" for="role">Password</label>
    <div class="col-md-9">
        {!! Form::password('password_confirmation',['class'=>$errors->has("password_confirmation") ? "form-control is-invalid" : "form-control" ])
        !!}
        <div class="invalid-feedback">
            {{ $errors->first("password_confirmation") }}
        </div>
    </div>
</div>

<div class="form-group row">
    <label class="col-md-3 col-form-label" for="role">Role</label>
    <div class="col-md-9">
        {!! Form::select('role_id',$roles,isset($model) ? $model->roles()->first()->id : null,['class'=>$errors->has("name") ? "form-control is-invalid" :
        "form-control" ]) !!}
        <div class="invalid-feedback">
            {{ $errors->first("role") }}
        </div>
    </div>
</div>