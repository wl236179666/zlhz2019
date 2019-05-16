<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2015 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

// [ 应用入口文件 ]
if(!file_exists(__DIR__ . '/../data/install.lock')){
    define('BIND_MODULE', 'install');
}

// 定义应用目录
define('APP_PATH', __DIR__ . '/../application/');
// 定义应用缓存目录
define('RUNTIME_PATH', __DIR__ . '/../runtime/');
// 开启调试模式
define('APP_DEBUG', true);
define('LOG_PATH',__DIR__.'/log/'); /*日志缓存路径*/



// 加载框架引导文件
require __DIR__ . '/../thinkphp/start.php';

/*初始化日志缓存配置*/
\think\Log::init([
	'type' 	=>	'File',
	'path'	=>	LOG_PATH,
	'level'	=>	['sql']
]);
