<?php
namespace app\index\controller;
use app\index\model\User as UserModel;
use think\Controller;

class User extends Controller
{
	//新增用户数据
	public function add()
	{
		$user  = new UserModel;
		$user->nickname ='测试';
		$user->email    ='test@qq.com';
		$user->birthday ='2012-01-20';
		if($user->save()){
			return '用户['.$user->nickname.':'.$user->id.']新增成功';
		}else{
			return $user->getError();
		}
	}
	//批量新增用户数据
	public function addList()
	{
		$user = new UserModel;
		$list = [
		   ['nickname' => '张三','email' => 'zhangshan@qq.com','birthday'=>strtotime('1988-01-15')],
		   ['nickname' => '李四','email' => 'lisi@qq.com','birthday'=> strtotime('1982-11-13')],
		];
		if($user->saveAll($list)){
			return '用户批量新增成功';
		} else {
			return $user->getError();
		}
	}
	//读取数据
	public function read($id)
	{
		$user = UserModel::get($id);
		$this->assign('user',$user);
		$this->assign('title','查看用户');	
		$this->view->replace(['__PUBLIC__' => '/static',]);
		$this->view->engine->layout('layout','{__CONTENT__}');	
		return $this->fetch();
	}
	//获取用户列表并输出
	public function index()
	{
		$list = UserModel::paginate(3);
		$this->assign('list',$list);
        $this->assign('title','查看用户清单');	
        $this->view->replace(['__PUBLIC__' => '/static',]);
	    $this->view->engine->layout('layout','{__CONTENT__}');		
		return $this->fetch();
	}
	//更新用户数据
	public function update($id)
	{
		$user['id']      = (int) $id;
		$user['nickname']='海报';
		$user['email'] ='thinkphp@qq.com';
		$result =UserModel::update($user);
		$this->read($id);
		//return '更新用户成功！';
	}
	//删除数据
	public function delete($id)
	{
		$user = UserModel::get($id);
		if ($user){
			$user->delete();
			return '删除成功';
		} else {
			return '删除的用户不存在';
		}
	}
	
	
	
}