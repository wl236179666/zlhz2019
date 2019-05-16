<?php
/**
 * 公共验证器
 */
namespace app\api\validate;

class LoginValidate extends BaseValidate
{
	protected $rule = [
		'username' => 'require',
		'password' => 'require'
	];

	protected $message = [
		'username' => '账号不能未空',
		'password' => '密码不能未空',
	];
}