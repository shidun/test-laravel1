<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Response;

class Activity
{
	//中间件前置
	// public function handle($request, Closure $next)
	// {
	// 	if (time() < strtotime('2018-11-11')) {
	// 		return redirect('activity0');
	// 	}
	// 	return $next($request);
	// }

	//中间件后置
	public function handle($request, Closure $next)
	{
		$response = $next($request);
		// var_dump(111);
		return $response;
		// var_dump($response) ;
		// //逻辑在请求后面执行

		// echo "我是后置操作";exit();
	}
}