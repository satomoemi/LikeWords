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
            $table->text('memo')->nullable(true);
            $table->unsignedBigInteger('folder_id');
            // $table->integer('push_id');
            $table->timestamps();

            // 外部キー制約を設定する
            //他のテーブルとの結びつきを表現するためのカラムに設定,folder_idにはfoldersのidの値しか入れることができない(入れることはできるけどエラーになる)(ここではFolderテーブルが親でWordテーブルが子)
            //onDelete('cascade')：外部キー制約に CASCADE を割り当てれば、紐づいている先のレコードが削除された際に一緒に削除される
            $table->foreign('folder_id')->references('id')->on('folders')->onDelete('cascade');
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
