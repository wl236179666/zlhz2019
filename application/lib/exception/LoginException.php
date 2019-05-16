<?php
/**
 * 参数异常错误
 */
namespace app\lib\exception;

class LoginException extends BaseException
{
	public $code = 400;
	public $msg = '账号或密码错误';
	public $errorCode = 20000;

}