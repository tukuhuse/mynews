<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('news', function (Blueprint $table) {
      $table->bigIncrements('id');              //自動連番
      $table->string('title');                  //ニュースのタイトル
      $table->string('body');                   //ニュースの本文
      $table->string('image_path')->nullable(); //画像のパス(空白を許可)
      $table->timestamps();                     //保存日時
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('news');
  }
}
