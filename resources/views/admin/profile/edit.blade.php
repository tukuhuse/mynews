{{-- layouts/profile.blade.phpを読み込む --}}
@extends('layouts.profile')

{{-- profile.blade.phpの@yield('title')に'Profile'を埋め込む --}}
@section('title', 'Profile')

{{-- profile.blade.phpの@yield('content')に以下のタグを埋め込む --}}
@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-8 mx-auto">
        <h2>プロフィールの編集</h2>
        <form action="{{ action('Admin\ProfileController@update') }}" method="post" enctype="multipart/form-data">
          @if (count($errors) > 0)
            <ul>
              @foreach($errors->all() as $e)
                <li>{{ $e }}</li>
              @endforeach
            </ul>
          @endif
          <div class="form-group row">
            <label class="col-md-2" for="name">氏名</label>
            <div class="col-md-10">
              <input type="text" class="form-control" name="name" value="{{ $profiles_form->name }}">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-md-2" for="gender">性別</label>
            <div class="col-md-10">
              <input type="radio" name="gender" value="man" {{ $profiles_form->gender == "man" ? 'checked' : '' }} > 男   
              <input type="radio" name="gender" value="woman" {{ $profiles_form->gender == "woman" ? 'checked' : '' }} > 女   
              <input type="radio" name="gender" value="transgender" {{ $profiles_form->gender == "transgender" ? 'checked' : '' }} >どちらでもない
            </div>
          </div>
          <div class="form-group row">
            <label class="col-md-2" for="hobby">趣味</label>
            <div class="col-md-10">
              <input type="text" class="form-control" name="hobby" value="{{ $profiles_form->hobby }}">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-md-2" for="introduction">自己紹介欄</label>
            <div class="col-md-10">
              <textarea class="form-control" name="introduction" rows="20">{{ $profiles_form->introduction }}</textarea>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-md-10">
              <input type="hidden" name="id" value="{{ $profiles_form->id }}">
              @csrf
              <input type="submit" class="btn btn-primary" value="更新">
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection