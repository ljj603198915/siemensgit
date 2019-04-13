<?php
namespace Admin\Model;
use Think\Model;
class ImageTextModel extends Model 
{
	protected $insertFields = array('msgid','title','int_page_read_count','share_count','datetime');
	protected $updateFields = array('id','msgid','title','int_page_read_count','share_count','datetime');
	protected $_validate = array(
		array('msgid', '1,60', '图文消息ID的值最长不能超过 60 个字符！', 2, 'length', 3),
		array('title', '1,255', '的值最长不能超过 255 个字符！', 2, 'length', 3),
		array('int_page_read_count', 'number', '图文页的阅读次数必须是一个整数！', 2, 'regex', 3),
		array('share_count', 'number', '图文分享次数必须是一个整数！', 2, 'regex', 3),
	);
	public function search($pageSize = 20)
	{
		/**************************************** 搜索 ****************************************/
		$where = array();
		if($msgid = I('get.msgid'))
			$where['msgid'] = array('like', "%$msgid%");
		if($title = I('get.title'))
			$where['title'] = array('like', "%$title%");
		if($int_page_read_count = I('get.int_page_read_count'))
			$where['int_page_read_count'] = array('eq', $int_page_read_count);
		if($share_count = I('get.share_count'))
			$where['share_count'] = array('eq', $share_count);
		if($datetime = I('get.datetime'))
			$where['datetime'] = array('eq', $datetime);
		/************************************* 翻页 ****************************************/
		$count = $this->alias('a')->where($where)->count();
        $page= new \Org\Util\MyPage($count,$pageSize);
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