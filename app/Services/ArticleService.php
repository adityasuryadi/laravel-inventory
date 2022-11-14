<?php

namespace App\Services;
use Illuminate\Support\Str;

class ArticleService {
    public function saveArticle($model,$data){
        $model->id   = Str::uuid();
        $model->name = $data->name;
        $model->save();
    }
}