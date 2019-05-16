<?php
namespace app\api\controller;

use think\Controller;
use app\api\validate\LoginValidate;
use app\api\server\Login as LoginServer;
use app\lib\exception\LoginException;


class Login extends Controller
{
    public function index()
    {
    	//验证参数
        (new LoginValidate())->gocheck();
        //账号密码
        $username = input('post.username');
    	$password = md5(input('post.password'). config('salt'));
        $result = (new LoginServer())->checkIsRegister();
        if(!$result){
        	throw new LoginException();
        }
        return  json([
			'result' => 'success',
			'data'	 => $result
		]);


    }
}
