<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLotshopTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lotshops', function (Blueprint $table) {
            $table->increments('id');
            //关联账号
            $table->string('loginusername',50);
            $table->integer('loginuserid',false,true);

            $table->string('nickname',50)->nullable() ;
            $table->string('realname',50)->nullable();
            $table->string('wechatnum',80)->nullable();
            $table->bigInteger('mobiletel',false,true)->nullable();
            $table->bigInteger('qqnum',false,true)->nullable();
            $table->string('email')->unique()->nullable();
            //现在的心情故事签名
            $table->string('signwords',200)->nullable();
            $table->string('avatarurl',200)->nullable();
            $table->string('shopbigarea',10)->nullable();
            $table->string('shopsmallarea',500)->nullable();
            $table->string('address',400)->nullable();
            //过去店里出现的一等奖数量
            $table->integer('firstaward',false,true)->nullable();
            $table->integer('secondaward',false,true)->nullable();
            $table->integer('thirdaward',false,true)->nullable();
            $table->integer('fourthaward',false,true)->nullable();
            $table->integer('fifthaward',false,true)->nullable();
            $table->integer('sixthaward',false,true)->nullable();
            //友谊店铺
            $table->string('friendshop',500)->nullable();
            //下级代理名单列表
            $table->string('downproxy',500)->nullable();
            //愿望目标
            $table->string('dreamtarget',300)->nullable();
            //店铺历史
            $table->string('shophistory',400)->nullable();
            //其他待定
            $table->string('otherthings',300)->nullable();
            $table->integer('othernum',false,false)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lotshops');
    }
}
