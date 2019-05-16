<?php
/**
 * 公共验证器
 */
namespace app\api\validate;
use think\Request;
use think\Exception;
use think\Validate;
use app\lib\exception\ParamsException;
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
			throw new ParamsException([/*实例化自定义异常*/
				'msg' => $this->error,
 			]); 
			
		}else{
			return true;
		}
	}
}