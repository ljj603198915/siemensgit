<?php
namespace Admin\Model;
use Think\Model;
class OnshopModel extends Model 
{
	protected $insertFields = array('shop_name','shop_url','shop_type');
	protected $updateFields = array('id','shop_name','shop_url','shop_type');
	protected $_validate = array(
		array('shop_name', 'require', '店铺名称不能为空！', 1, 'regex', 3),
		array('shop_name', '1,255', '的值最长不能超过 255 个字符！', 1, 'length', 3),
		array('shop_url', 'require', '店铺链接地址不能为空！', 1, 'regex', 3),
		array('shop_url', '1,255', '的值最长不能超过 255 个字符！', 1, 'length', 3),
        array('shop_type', 'require', '店铺类型不能为空！', 1, 'regex', 3),
        array('shop_type', '1,255', '的值最长不能超过 255 个字符！', 1, 'length', 3),
	);
	public function search($pageSize = 20)
	{
		/**************************************** 搜索 ****************************************/
		$where = array();
		if($shop_name = I('get.shop_name'))
			$where['shop_name'] = array('like', "%$shop_name%");
		if($shop_type = I('get.shop_type'))
			$where['shop_type'] = array('eq', "$shop_type");
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
        if (!preg_match("/^(http|ftp):/", $data['shop_url'])){
               $data['shop_url'] = 'http://'.$data['shop_url'];

         }

    }
	// 修改前
	protected function _before_update(&$data, $option)
	{
        if (!preg_match("/^(http|ftp):/", $data['shop_url'])){
            $data['shop_url'] = 'http://'.$data['shop_url'];
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