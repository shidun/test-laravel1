<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
	const SEX_UN = 0;
	const SEX_BOY = 1;
	const SEX_GRIL = 2;

	//指定表明 默认是students
	protected $table = 'cmf_user';

	//指定id
	protected $primaryKey = 'id';

	//指定允许批量赋值的字段
	protected $fillable = ['user_nickname', 'birthday', 'sex', 'remark', 'create_time'];

	//指定不允许批量赋值的字段
	protected $guarded =[];

	//关闭自动插入时间 updated_at created_at 自动维护时间戳
	public $timestamps = false;

	public function sexs($ind = null)
	{
		$arr = [
			self::SEX_UN => '未知',
			self::SEX_BOY => '男',
			self::SEX_GRIL => '女',
		];

		if ($ind !== null) {
			return array_key_exists($ind, $arr) ? $arr[$ind] : $arr[self::SEX_UN];
		}

		return $arr;
	}

	protected function getDataFormat()
	{
		return time();
	}

	protected function asDataTime($val)
	{
		return $val;
	}
}