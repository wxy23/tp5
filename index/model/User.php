<?php
namespace app\index\model;
use think\Model;

class User extends Model
{
	//protected $dateFormat ='Y-m-d';
	protected $type =[
	     //设置birthday为时间戳类型（整型）
		 'birthday' => 'timestamp:Y-m-d',
	];
	// birthday读取器
	// protected function getBirthdayAttr($birthday)
	// {
		// return date('Y-m-d',$birthday);
	// }
	//user_birthday读取器,由birthday转换得新属性
	protected function getUserBirthdayAttr($value,$data)
	{
		return date('Ymd',$data['birthday']);
	}
	//birthday修改器
	// protected function setBirthdayAttr($value)
	// {
		// return strtotime($value);
	// }
	//定义自动完成的属性
	protected $insert =['status'];
	protected function setStatusAttr($value,$data)
	{
		return '流年' == $data['nickname']?1:2;
	}
	protected function getStatusAttr($value)
	{
		$status =[-1=>'删除',0=>'禁用',1=>'正常',2=>'待审'];
		return $status[$value];
	}
	//email 查询
	protected function scopeEmail($query)
	{
		$query->where('email','thinkphp@qq.com');

	}
	//status查询
	protected function scopeStatus($query)
	{
		$query->where('status',1);
	}
}