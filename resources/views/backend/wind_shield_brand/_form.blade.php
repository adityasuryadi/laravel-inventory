<div class="form-group row">
    <label class="col-md-3 col-form-label" for="customer">Merk Kaca</label>
    <div class="col-md-3">
        {!! Form::text('name',null,['class'=>$errors->has("name") ? "form-control is-invalid" : "form-control"]) !!}
        <div class="invalid-feedback">
            {{ $errors->first("name") }}
        </div>
    </div>
</div>