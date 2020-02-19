<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Profile;

class ProfileController extends Controller
{
    //以下のコントローラーを追記
    public function add() {
      return view('admin.profile.create');
    }
    
    public function create(Request $request) {
      $this->validate($request, Profile::$rules);
      
      $profiles=new Profile;
      $form=$request->all();
      
      unset($form['_token']);
      
      $profiles->fill($form);
      $profiles->save();
      
      return redirect('admin/profile/create');
    }
    
    public function edit(Request $request) {
      $profiles=Profile::find($request->id);
      if (empty($profiles)) {
        abort(404);
      }
      return view('admin.profile.edit', ['profiles_form' => $profiles]);
    }
    
    public function update(Request $request) {
      //フォームデータ正規化
      $this->validate($request, Profile::$rules);
      //該当データを検索
      $profiles=Profile::find($request->id);
      //送信されてきたフォームデータを格納
      $profiles_form=$profiles->all();
      //いらないフォームデータを削除
      unset($profiles_form['_token']);
      
      $profiles->fill($profiles_form)->save();
      
      return redirect('admin/profile/edit');
    }
}
