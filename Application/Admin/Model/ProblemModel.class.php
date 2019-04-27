<?php
namespace Admin\Model;
use Think\Model;
class ProblemModel extends Model 
{
	protected $insertFields = array('problem_type','problem_name','is_use');
	protected $updateFields = array('id','problem_type','problem_name','is_use');
	protected $_validate = array(
		array('problem_type', 'require', '1常见问题2产品问题3接线问题不能为空！', 1, 'regex', 3),
		array('problem_type', 'number', '1常见问题2产品问题3接线问题必须是一个整数！', 1, 'regex', 3),
		array('problem_name', 'require', '不能为空！', 1, 'regex', 3),
		array('problem_name', '1,255', '的值最长不能超过 255 个字符！', 1, 'length', 3),
		array('is_use', 'number', '1使用0停用必须是一个整数！', 2, 'regex', 3),
	);
	public function search($pageSize = 20)
	{
		/**************************************** 搜索 ****************************************/
		$where = array();
		if($problem_type = I('get.problem_type'))
			$where['problem_type'] = array('eq', $problem_type);
		if($problem_name = I('get.problem_name'))
			$where['problem_name'] = array('like', "%$problem_name%");
		if($is_use = I('get.is_use'))
			$where['is_use'] = array('eq', $is_use);
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