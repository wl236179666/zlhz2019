<?php
/**
 * 参数异常错误
 */
namespace app\lib\exception;

class ParamsException extends BaseException
{
	public $code = 400;
	public $msg = '参数错误';
	public $errorCode = 10000;

}