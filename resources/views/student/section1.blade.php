
@extends('layouts')

@section('header')
@parent
111
@stop

@section('sidebar')
@parent
sidebar
@stop

@section('content')
@parent
content
{{ $name }}

<!-- 模板调用php代码 -->
{{ time() }}
{{ date('Y-m-d H:i:s', time()) }}

{{ in_array($name, $arr)?'true':'false' }}

{{ var_dump($arr) }}

{{ isset($name)?$name:'default' }}

{{ $name1 or 'default' }}

<!-- 原样输出 -->
@{{ $name }}

<!-- 模板中的注释 -->
{{-- --}}

<!-- 引入子视图 -->
@include('student.aaa', array('message' => '2222'))
@stop
<br>
@if ($name == 'shidun')
	is shidun
@elseif ($name == 'imooc')
is imooc 
@else
i?222
@endif
<!-- if的取反 -->
<!-- @unless( @name != 'shidun')
222
@endunless

@for ($i=0; $i<10; $i++)
<p>	{{ $i }}</p>
@endfor

@foreach($users as $user)
		<p>	{{ $user->user_nickname }}</p>
@endforeach -->

<!-- @forelse($users as $user)
		<p>{{ $user->user_nickname }}	</p>
@empty
		空空空空
@endforelse -->

<a href="{{url('url')}}">aaa</a><br>	

<a href="{{action('StudentController@urlTest')}}">urlTest</a>
<br>	
<a href="{{route('url')}}">route</a>
