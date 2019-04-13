<?php
namespace FootballAdmin\Model;
use Think\Model;
class TeamModel extends Model 
{
	protected $insertFields = array('team_name');
	protected $updateFields = array('id','team_name');
	protected $_validate = array(
		array('team_name', '1,255', '队伍名称的值最长不能超过 255 个字符！', 2, 'length', 3),
	);
	public function search($pageSize = 20)
	{
		/**************************************** 搜索 ****************************************/
		$where = array();
		if($team_name = I('get.team_name'))
			$where['team_name'] = array('like', "%$team_name%");
		/************************************* 翻页 ****************************************/
		$count = $this->alias('a')->where($where)->count();
		$page = new \Think\Page($count, $pageSize);
		// 配置翻页的样式
		$page->setConfig('prev', '上一页');
		$page->setConfig('next', '下一页');
		$data['page'] = $page->show();
		/************************************** 取数据 ******************************************/
		$data['data'] = $this->alias('a')->where($where)->group('a.id')->limit($page->firstRow.','.$page->listRows)->select();
		return $data;
	}
	// 添加前
	protected function _before_insert(&$data, $option)
	{
		if(isset($_FILES['team_image']) && $_FILES['team_image']['error'] == 0)
		{
			$ret = uploadImage('team_image', 'Team');

			if($ret['ok'] == 1)
			{
				$data['team_image'] = $ret['images'][0];
			}
			else 
			{
				$this->error = $ret['error'];
				return FALSE;
			}
		}
	}
	// 修改前
	protected function _before_update(&$data, $option)
	{
		if(isset($_FILES['team_image']) && $_FILES['team_image']['error'] == 0)
		{
			$ret = uploadImage('team_image', 'Team');
			if($ret['ok'] == 1)
			{
				$data['team_image'] = $ret['images'][0];
			}
			else 
			{
				$this->error = $ret['error'];
				return FALSE;
			}
		}
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