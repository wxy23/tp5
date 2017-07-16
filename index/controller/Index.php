<?php
namespace app\index\controller;
use think\Db;

class Index 
{
    public function index()
    {
		$result = Db::name('data')
		->whereTime('create_time','between',['2017-5-26','2017-6-2'])
		 		  ->select();
	   dump($result);
    }
}
 