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
            $table->string('memo');
            $table->integer('folders_id');
            $table->integer('pushes_id');
            $table->timestamps();

            // 外部キー制約を設定する.実際に存在するフォルダIDの値しか入れることができない
            $table->foreign('folders_id')->references('id')->on('folder');
            $table->foreign('pushes_id')->references('id')->on('push');

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
