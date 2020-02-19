<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

//News Modelを使えるようにする
use App\News;
use App\History;
use Carbon\Carbon;

class NewsController extends Controller
{
  public function add() {
    return view('admin.news.create');
  }
  
  public function create(Request $request) {
    
    //Varidationを行う
    $this->validate($request, News::$rules);
    
    $news = new News;
    $form = $request->all();
    
    //画像処理
    if(isset($form['image'])) {
      $path=$request->file('image')->store('public/image');
      $news->image_path=basename($path);
    } else {
      $news->image_path=null;
    }
    
    //_tokenを削除
    unset($form['_token']);
    //imageを削除
    unset($form['image']);
    
    //データベースに保存
    $news->fill($form);
    $news->save();
    
    //admin/news/createにリダイレクト
    return redirect('admin/news/create');
  }
  
  public function index(Request $request) {
    $cond_title=$request->cond_title;
    // 検索された場合
    if ($cond_title != '') {
      // 検索結果を取得
      $posts=News::where('title', $cond_title)->get();
    } else {
      $posts=News::all();
    }
    return view('admin.news.index', ['posts' => $posts, 'cond_title' => $cond_title]);
  }
  
  public function edit(Request $request) {
    //News Modelからデータを取得する
    $news=News::find($request->id);
    if (empty($news)) {
      abort(404);
    }
    return view('admin.news.edit', ['news_form' => $news]);
  }
  
  public function update(Request $request) {
    $this->validate($request, News::$rules);
    // News Modelからデータを取得する
    $news=News::find($request->id);
    // 送信されてきたフォームデータを格納する
    $news_form = $request->all();
    if (isset($news_form['image'])) {
      $path=$request->file('image')->store('public/image');
      $news->image_path = basename($path);
      unset($news_form['image']);
    } elseif (isset($request->remove)) {
      $news->image_path=null;
      unset($news_form['remove']);
    }
    unset($news_form['_token']);
    
    $news->fill($news_form)->save();
    
    //編集履歴追加
    $history=new History;
    $history->news_id = $news->id;
    $history->edited_at = Carbon::now();
    $history->save();
    
    return redirect('admin/news');
  }
  
  public function delete(Request $request) {
    $news=News::find($request->id);
    
    $news->delete();
    return redirect('admin/news/');
  }
}
