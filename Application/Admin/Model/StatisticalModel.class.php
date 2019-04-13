<?php
namespace Admin\Model;
use Think\Model;
class StatisticalModel extends Model
{
	protected $insertFields = array('name','count','datetime');
	protected $updateFields = array('id','name','count','datetime');
	protected $_validate = array(
		array('name', '1,60', '的值最长不能超过 60 个字符！', 2, 'length', 3),
		array('count', 'number', '必须是一个整数！', 2, 'regex', 3),
	);
	public function search($pageSize = 20)
	{
		/**************************************** 搜索 ****************************************/
		$where = array();
		if($nickname = I('get.nickname'))
			$where['nickname'] = array('like', "%$nickname%");
		if($sex = I('get.sex'))
			$where['sex'] = array('eq', $sex);
		/************************************* 翻页 ****************************************/
		$model=D('Weichat_fans');
		$count = $model->where($where)->count();
        $page= new \Org\Util\MyPage($count,$pageSize);
		// 配置翻页的样式
		$page->setConfig('prev', '上一页');
		$page->setConfig('next', '下一页');
		$data['page'] = $page->show();
		/************************************** 取数据 ******************************************/
		$data['data'] = $model->where($where)->order('subscribe desc,id desc')->limit($page->firstRow.','.$page->listRows)->select();
		return $data;
	}

	/************************************ 其他方法 ********************************************/
}