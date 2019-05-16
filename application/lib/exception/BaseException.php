<?php
/**
 * 异常处理公共类
 */
namespace app\lib\exception;
use think\Exception;

class BaseException extends Exception
{
	public $code = 400; /*状态码*/

	public $msg = '参数错误';

	public $errorCode = 10000; /*自定义错误码*/

	public function __construct($params = [])
	{
		if(!is_array($params) || empty($params)){
			return;
		}

		if(array_key_exists('code', $params)){
			$this->code = $params['code'];
		}
		if(array_key_exists('msg',$params)){
			$this->msg = $params['msg'];
		}
		if(array_key_exists('errorCode',$params)){
			$this->errorCode = $params['errorCode'];
		}
	}
}