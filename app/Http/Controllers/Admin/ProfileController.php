<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Profile;
use App\ProfileHistory;
use Carbon\Carbon;

class ProfileController extends Controller
{
    //以下のコントローラーを追記
    public function add() {
      return view('admin.profile.create');
    }
    
    public function create(Request $request) {
      $this->validate($request, Profile::$rules);
      
      $profile=new Profile;
      $form=$request->all();
      
      unset($form['_token']);
      
      $profile->fill($form);
      $profile->save();
      
      return redirect('admin/profile/create');
    }
    
    public function edit(Request $request) {
      $profile=Profile::find($request->id);
      if (empty($profile)) {
        abort(404);
      }
      return view('admin.profile.edit', ['profile_form' => $profile]);
    }
    
    public function update(Request $request) {
      //フォームデータ正規化
      $this->validate($request, Profile::$rules);
      //該当データを検索
      $profile=Profile::find($request->id);
      //送信されてきたフォームデータを格納
      $profile_form=$profile->all();
      //いらないフォームデータを削除
      unset($profile_form['_token']);
      
      $profile->fill($profile_form)->save();
      
      //編集履歴を追加
      $history=new ProfileHistory;
      $history->profile_id=$profile->id;
      $history->edited_at=Carbon::now();
      $history->save();
      
      return redirect('admin/profile/edit');
    }
}
