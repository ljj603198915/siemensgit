<?php
namespace Admin\Model;
use Think\Model;
class JoinInModel extends Model 
{
	protected $insertFields = array('name','phone','province','city','agent_product','status','created_time','handle_time');
	protected $updateFields = array('id','name','phone','province','city','agent_product','status','created_time','handle_time');
	protected $_validate = array(
		array('name', '1,255', '的值最长不能超过 255 个字符！', 2, 'length', 3),
		array('phone', '1,255', '的值最长不能超过 255 个字符！', 2, 'length', 3),
		array('province', '1,255', '的值最长不能超过 255 个字符！', 2, 'length', 3),
		array('city', '1,255', '的值最长不能超过 255 个字符！', 2, 'length', 3),
		array('status', 'number', '必须是一个整数！', 2, 'regex', 3),
		array('created_time', 'require', '不能为空！', 1, 'regex', 3),
	);
	public function search($pageSize = 20)
	{
		/**************************************** 搜索 ****************************************/
		$where = array();
		if($name = I('get.name'))
			$where['name'] = array('like', "%$name%");
		if($phone = I('get.phone'))
			$where['phone'] = array('like', "%$phone%");
		if($province = I('get.province'))
			$where['province'] = array('like', "%$province%");
		if($city = I('get.city'))
			$where['city'] = array('like', "%$city%");
		if($agent_product = I('get.agent_product'))
			$where['agent_product'] = array('eq', $agent_product);
		if($status = I('get.status'))
			$where['status'] = array('eq', $status);
		$created_timefrom = I('get.created_timefrom');
		$created_timeto = I('get.created_timeto');
		if($created_timefrom && $created_timeto)
			$where['created_time'] = array('between', array(strtotime("$created_timefrom 00:00:00"), strtotime("$created_timeto 23:59:59")));
		elseif($created_timefrom)
			$where['created_time'] = array('egt', strtotime("$created_timefrom 00:00:00"));
		elseif($created_timeto)
			$where['created_time'] = array('elt', strtotime("$created_timeto 23:59:59"));
		$handle_timefrom = I('get.handle_timefrom');
		$handle_timeto = I('get.handle_timeto');
		if($handle_timefrom && $handle_timeto)
			$where['handle_time'] = array('between', array(strtotime("$handle_timefrom 00:00:00"), strtotime("$handle_timeto 23:59:59")));
		elseif($handle_timefrom)
			$where['handle_time'] = array('egt', strtotime("$handle_timefrom 00:00:00"));
		elseif($handle_timeto)
			$where['handle_time'] = array('elt', strtotime("$handle_timeto 23:59:59"));
		/************************************* 翻页 ****************************************/
		$count = $this->alias('a')->where($where)->count();
        $page= new \Org\Util\MyPage($count,$pageSize);
        // 配置翻页的样式
        $page->setConfig('prev', '上一页');
        $page->setConfig('next', '下一页');
        $data['page'] = $page->show();
		/************************************** 取数据 ******************************************/
		$data['data'] = $this->alias('a')->where($where)->group('a.id')->order("a.status asc, a.created_time desc")->limit($page->firstRow.','.$page->listRows)->select();
		return $data;
	}
	// 添加前
	protected function _before_insert(&$data, $option)
	{
	}
	// 修改前
	protected function _before_update(&$data, $option)
	{
	}
	// 删除前
	protected function _before_delete($option)
	{
		if(is_array($option['where']['id']))
		{
			$this->error = '不支持批量删除';
			return FALSE;
		}
	}
	/************************************ 其他方法 ********************************************/
}