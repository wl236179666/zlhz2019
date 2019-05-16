<?php

namespace app\lib\exception;

use think\Exception;
use think\Request;
use think\Log;
use think\exception\Handle;

class ExceptionHandler extends Handle
{
	private $code;
	private $msg;
	private $errorCode;

	public function render(\Exception $e){
		if($e instanceof BaseException){
			//如果是自定义的异常
			$this->code = $e->code;
			$this->msg = $e->msg;
			$this->errorCode = $e->errorCode;
		}else{
			if(config('app_debug')){
				//tp5框架自带的报错页面
				return parent::render($e);
			}else{
				//自定义的返回错误
				//服务器异常
				$this->code = 500;
				$this->msg = '系统错误';
				$this->errorCode = 999;
				//记录日志
				$this->recordErrorLog($e);
			}
			
		}
		$result = [
				'result' => 'error',
				'msg' => $this->msg,
				'error_code' 	=> $this->errorCode,
			];
		return json($result,$this->code);
	}

	//
	//记录日志
	private function recordErrorLog(\Exception $e)
	{
		//初始化日志
		Log::init([
			// 日志记录方式，内置 file socket 支持扩展
		    'type'  => 'File',
		    // 日志保存目录
		    'path'  => LOG_PATH,
		    // 日志记录级别
		    'level' => ['error'],
		]);
		Log::record($e->getMessage(),'error');
	}
}