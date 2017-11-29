<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableArticle extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 50)->unique()->comment('标题');
            $table->string('subhead',50)->comment('副标题');
            $table->string('desc',255)->comment('摘要');
            $table->string('thumb',255)->comment('缩略图');
            $table->string('author',255)->comment('作者');
            $table->integer('author_id')->comment('作者ID');
            $table->integer('tag_id')->comment('标签id,多个使用英文逗号隔开');
            $table->tinyInteger('status')->default(1)->comment('状态，1表示开启，0关闭');
            $table->integer('sort')->comment('排序')->default(0);
            $table->string('clicks')->default(0)->comment('阅读量');
            $table->timestamps();

            $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
