@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <strong>Input Penjualan</strong>
    </div>
    <div class="card-body">
    

<div class="form-group row">
            <label class="col-md-3 col-form-label" for="customer">Merk Mobil</label>
            <div class="col-md-3">
                    <?php $articles=App\Models\BrandCar::select('name','id')->get() ?>
                    <vue-select :value='@json($articles)' name="brand_car_id" :value-id="'{{ old('article_id',$product->article_id ?? null) }}'"></vue-select>
            <div class="invalid-feedback">
                {{ $errors->first("name") }}
            </div>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-md-3 col-form-label" for="customer">Nama Mobil</label>
            <div class="col-md-3">
            {{ Form::select('name',['Jazz','Brio','Mobilio'],null,['class'=>'form-control'])}}
            <div class="invalid-feedback">
                {{ $errors->first("name") }}
            </div>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-md-3 col-form-label" for="customer">Tahun</label>
            <div class="col-md-3">
            {{ Form::select('name',['2011','2012','2013'],null,['class'=>'form-control'])}}
            <div class="invalid-feedback">
                {{ $errors->first("year") }}
            </div>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-md-3 col-form-label" for="customer">Jenis Mobil</label>
            
            <div class="col-md-3">
            {{ Form::select('name',['RS GE MT','RS GE CVT'],null,['class'=>'form-control'])}}
            <div class="invalid-feedback">
                {{ $errors->first("name") }}
            </div>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-md-3 col-form-label" for="customer">Merk Kaca</label>
            <div class="col-md-3">
            {{ Form::select('name',['Solar Guard','v-kool','Mobilio'],null,['class'=>'form-control'])}}
            <div class="invalid-feedback">
                {{ $errors->first("name") }}
            </div>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-md-3 col-form-label" for="customer">Bagian Kaca</label>
            <div class="col-md-3">
                    <input type="radio" name="" id="" /> Depan <br />
                    <input type="radio" name="" id="" /> Belakang <br />
                    <input type="radio" name="" id="" /> Kiri <br />
                    <input type="radio" name="" id="" /> Kanan <br />
            <div class="invalid-feedback">
                {{ $errors->first("name") }}
            </div>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-md-3 col-form-label" for="customer">Qty</label>
            <div class="col-md-2">
                    {!! Form::text('name',null,['class'=>$errors->has("name") ? "form-control is-invalid" : "form-control"]) !!}
            <div class="invalid-feedback">
                {{ $errors->first("name") }}
            </div>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-md-3 col-form-label" for="customer">Harga Jual</label>
            <div class="col-md-3">
                    {!! Form::text('name',null,['class'=>$errors->has("name") ? "form-control is-invalid" : "form-control"]) !!}
            <div class="invalid-feedback">
                {{ $errors->first("name") }}
            </div>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-md-3 col-form-label" for="customer">Rak</label>
            <div class="col-md-3">
            {{ Form::select('name',['1','2','3'],null,['class'=>'form-control'])}}
            <div class="invalid-feedback">
                {{ $errors->first("name") }}
            </div>
            </div>
        </div>

    </div>
    <div class="card-footer">
        <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-dot-circle-o"></i> Simpan</button>
    </div>
</div>
@endsection