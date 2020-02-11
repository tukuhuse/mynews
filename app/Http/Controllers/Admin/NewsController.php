<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

//News Modelを使えるようにする
use App\News;

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
}
