<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('words', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('word');
            $table->text('memo');
            $table->unsignedBigInteger('folder_id');
            // $table->integer('pushes_id');
            $table->timestamps();

            // 外部キー制約を設定する
            //他のテーブルとの結びつきを表現するためのカラムに設定,フォルダID列には実際に存在するフォルダIDの値しか入れることができない
            $table->foreign('folders_id')->references('id')->on('folders');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('words');
    }
}
