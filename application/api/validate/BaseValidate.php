<?php
/**
 * 公共验证器
 */
namespace app\api\validate;
use think\Request;
use think\Exception;
use think\Validate;

class BaseValidate extends Validate
{
	public function goCheck()
	{
		//获取参数
		$params = Request::instance()->param();
		//对参数进行校验
		$result = $this->batch()->check($params); //批量验证
		if(!$result){ 
			/*错误异常*/
			$e = new ParameterException([/*实例化自定义异常*/
				'msg' => $this->error,
 			]); 
			//$e->msg = $this->error; /*异常提示信息*/
			/*抛出异常*/
			throw $e;
		}else{
			return true;
		}
	}
}