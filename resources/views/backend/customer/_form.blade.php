<div class="form-group row">
            <label class="col-md-3 col-form-label" for="customer">Nama</label>
            <div class="col-md-9">
                    {!! Form::text('name',null,['class'=>$errors->has("name") ? "form-control is-invalid" : "form-control"]) !!}
            <div class="invalid-feedback">
                {{ $errors->first("name") }}
            </div>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-3 col-form-label" for="customer">Alamat</label>
            <div class="col-md-9">
                    {!! Form::textarea('address',null,['class'=>$errors->has("address") ? "form-control is-invalid" : "form-control"]) !!}
            <div class="invalid-feedback">
                {{ $errors->first("address") }}
            </div>
            </div>
        </div>