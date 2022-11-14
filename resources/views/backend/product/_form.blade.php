<div class="form-group row">
                <label class="col-md-3 col-form-label" for="article">Merk Mobil</label>
                <div class="col-md-9">
                    <?php $articles=App\Models\Article::select('name','id')->get() ?>
                    <vue-select :value='@json($articles)' name="article_id" :value-id="'{{ old('article_id',$product->article_id ?? null) }}'"></vue-select>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-md-3 col-form-label" for="article">Nama Mobil</label>
                <div class="col-md-9">
                    <?php $articles=App\Models\Article::select('name','id')->get() ?>
                    <vue-select :value='@json($articles)' name="article_id" :value-id="'{{ old('article_id',$product->article_id ?? null) }}'"></vue-select>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-md-3 col-form-label" for="article">Type Mobil</label>
                <div class="col-md-9">
                    <?php $articles=App\Models\Article::select('name','id')->get() ?>
                    <vue-select :value='@json($articles)' name="article_id" :value-id="'{{ old('article_id',$product->article_id ?? null) }}'"></vue-select>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-md-3 col-form-label" for="article">Article / Code</label>
                <div class="col-md-9">
                    <?php $articles=App\Models\Article::select('name','id')->get() ?>
                    <vue-select :value='@json($articles)' name="article_id" :value-id="'{{ old('article_id',$product->article_id ?? null) }}'"></vue-select>
                </div>
            </div>

        
<div class="form-group row">
                <label class="col-md-3 col-form-label" for="article">Article / Code</label>
                <div class="col-md-9">
                    <?php $articles=App\Models\Article::select('name','id')->get() ?>
                    <vue-select :value='@json($articles)' name="article_id" :value-id="'{{ old('article_id',$product->article_id ?? null) }}'"></vue-select>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-md-3 col-form-label" for="article">Warna</label>
                <div class="col-md-9">
                    {!! Form::text('color',null,['class'=>'form-control','placeholder'=>'Warna']) !!}
                </div>
            </div>

            <div class="form-group row">
                <label class="col-md-3 col-form-label" for="article">PCS</label>
                <div class="col-md-3">
                    {!! Form::text('pcs',null,['class'=>'form-control','placeholder'=>'PCS']) !!}
                </div>
            </div>

            <div class="form-group row">
                <label class="col-md-3 col-form-label" for="article">Jumlah</label>
                <div class="col-md-3">
                    {!! Form::text('amount',null,['class'=>'form-control','placeholder'=>'Jumlah']) !!}
                </div>
            </div>

            <div class="form-group row">
                <label class="col-md-3 col-form-label" for="article">Harga / Yard</label>
                <div class="col-md-3">
                    {!! Form::text('price',null,['class'=>'form-control','placeholder'=>'Harga']) !!}
                </div>
            </div>

            <div class="form-group row">
                <label class="col-md-3 col-form-label" for="article">Satuan</label>
                <div class="col-md-3">
                    {!! Form::select('unit_id',App\Models\SysValue::where('name','=','unit')->pluck('value','id'),null,['class'=>'form-control','placeholder'=>'Satuan']) !!}
                </div>
            </div>

            <div class="form-group row">
                <label class="col-md-3 col-form-label" for="article">Harga Pokok</label>
                <div class="col-md-3">
                    {!! Form::text('principal_price',null,['class'=>'form-control','placeholder'=>'Harga']) !!}
                </div>
            </div>