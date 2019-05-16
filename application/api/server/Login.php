<?php
namespace app\api\server;

use app\admin\model\CompanyModel;
use think\Controller;

class Login
{
    public function checkIsRegister()
    {
    	$username = input('post.username');
    	$password = md5(input('post.password'). config('salt'));
    	var_dump($username);
    	var_dump($password);die;

        return CompanyModel::where(['username'=>$username,'password'=>$password])->find();
    }
}