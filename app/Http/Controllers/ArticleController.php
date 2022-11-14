<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Services\ArticleService;
use App\Http\Requests\ArticleRequest;
use App\DataTables\ArticleDataTable;
class ArticleController extends Controller
{
    public function index(ArticleDataTable  $dataTable){
        $this->authorize('article.create');
        $title = "List Artikel";
        return $dataTable->render('backend.article.index',compact('title'));
    }

    public function create(){
        $this->authorize('article.create');
        return view('backend.article.create');
    }

    public function store(ArticleRequest $request){
        $this->authorize('article.create');
        $service = new ArticleService;
        $model   = new Article;
        $service->saveArticle($model,$request);

        return redirect()->route('article.index');
    }

    public function edit($id){
        $this->authorize('article.edit');
        $article=Article::findOrFail($id);
        return view('backend.article.edit')
        ->withTitle('Edit Artikel '.$article->name)
        ->withArticle($article);
    }

    public function update($id,Request $request){
        $this->authorize('article.delete');
        $article=Article::findOrFail($id);
        $article->name = $request->input('name');
        $article->save();

        return redirect()->route('article.index');
    }

    public function getArticles(){
        $articles=Article::all();
        return $articles;
    }
}
