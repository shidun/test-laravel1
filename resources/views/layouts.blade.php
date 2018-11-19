<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document @yield('title')</title>
</head>
<body>
	<div>
		@section('header')
		头部
		@show
	</div>

	<div>
		@section('sidebar')
		侧边栏
		@show
	</div>
	<div>
		@yield('content','主要内容区域')
	</div>

	<div>
		@section('footer')
		底部
		@show
	</div>
</body>
</html>