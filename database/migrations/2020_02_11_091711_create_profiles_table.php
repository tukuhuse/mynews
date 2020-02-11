<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfilesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('profiles', function (Blueprint $table) {
      $table->bigIncrements('id');    //オートナンバー
      $table->string('name');         //名前
      $table->string('gender');       //性別
      $table->string('hobby');        //趣味
      $table->string('introduction'); //自己紹介
      $table->timestamps();           //保存日時
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('profiles');
  }
}
