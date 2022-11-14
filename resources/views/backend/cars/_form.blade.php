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
                    {!! Form::text('name',null,['class'=>$errors->has("name") ? "form-control is-invalid" : "form-control"]) !!}
            <div class="invalid-feedback">
                {{ $errors->first("name") }}
            </div>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-md-3 col-form-label" for="customer">Tahun</label>
            <div class="col-md-3">
                    {!! Form::text('year',null,['class'=>$errors->has("year") ? "form-control is-invalid" : "form-control"]) !!}
            <div class="invalid-feedback">
                {{ $errors->first("year") }}
            </div>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-md-3 col-form-label" for="customer">Jenis Mobil</label>
            <div class="col-md-6">
                    <input-multiple-text></input-multiple-text>
            <div class="invalid-feedback">
                {{ $errors->first("name") }}
            </div>
            </div>
        </div>

        