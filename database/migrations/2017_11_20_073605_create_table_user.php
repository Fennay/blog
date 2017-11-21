<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableUser extends Migration
{
    /**
     * Run the migrations.
     * @return void
     */
    public function up()
    {
        Schema::create('user', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username', 50)->comment('用户名');
            $table->string('password',255)->comment('密码');
            $table->string('email')->unique();
            $table->string('telephone', 15);
            $table->tinyInteger('sex')->default(0)->comment('性别，1表示男，0表示女');
            $table->tinyInteger('status')->default(0)->comment('状态，1表示开启，0关闭');
            $table->integer('sort')->comment('排序');
            $table->timestamps();

            $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down()
    {
        //
    }
}
