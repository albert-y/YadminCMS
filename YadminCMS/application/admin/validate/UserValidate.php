<?php
/**
 * Created by PhpStorm.
 * User: yuanjianqiu
 * Date: 2018/3/26
 * Time: 19:14
 */
use think\Validate;

class UserValidate extends Validate
{
    protected $rule=[

        'user_login' => 'require|unique:user,user_login',
        'user_pass'  => 'require',
        'user_email' => 'require|email|unique:user,user_email',
    ];

    protected $message=[

        'user_login.require' => '用户不能为空',
        'user_login.unquire' => '用户名已存在',
        'user_pass.require'  => '密码不能为空',
        'user_email.require' => '邮箱不能为空',
        'user_email.email'   => '邮箱格式正确',
        'user_email.unquire' => '邮箱已存在'

    ];
}