<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lotshop extends Model
{
    //
    protected  $guarded = [
'id','created_at'
    ];
    public static $rules = [
        'nickname' => 'required|max:50',
        'realname' => 'max:10',
        'wechatnum' => 'required|max:50',

    ];
    public static $messages = [
        'nickname.required' => '必须输入昵称',
        'nickname.max' => '最长不超过50字',
        'realname.max' => '真是姓名不可超过10字',
        'wechatnum.required' => '必须输入微信号',
        'wechatnum.max' => '微信号码最长不超过50字',
    ];
}
