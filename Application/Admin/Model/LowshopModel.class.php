<?php
namespace Admin\Model;
use Think\Model;
class LowshopModel extends Model 
{
	protected $insertFields = array('shop_name','province','city','district','address','longitude','latitude','shop_type','on_sale','on_activity');
	protected $updateFields = array('id','shop_name','province','city','district','address','longitude','latitude','shop_type','on_sale','on_activity');
	protected $_validate = array(
		array('shop_name', 'require', '店铺名称不能为空！', 1, 'regex', 3),
		array('shop_name', '1,255', '店铺名称的值最长不能超过 255 个字符！', 1, 'length', 3),
		array('province', '1,60', '省份的值最长不能超过 60 个字符！', 2, 'length', 3),
		array('city', 'require', '城市不能为空！', 1, 'regex', 3),
		array('city', '1,60', '城市的值最长不能超过 60 个字符！', 1, 'length', 3),
		array('district', 'require', '区（县）不能为空！', 1, 'regex', 3),
		array('district', '1,60', '区（县）的值最长不能超过 60 个字符！', 1, 'length', 3),
		array('address', 'require', '详细地址不能为空！', 1, 'regex', 3),
		array('address', '1,255', '详细地址的值最长不能超过 255 个字符！', 1, 'length', 3),
		//array('telephone', 'require', '联系电话不能为空！', 1, 'regex', 3),
		//array('telephone', '1,60', '联系电话的值最长不能超过 60 个字符！', 1, 'length', 3),
       // array('telephone', '/^(((13[0-9]{1})|(15[0-9]{1})|(18[0-9]{1})|(17[0-9]{1})|(14[0-9]{1}))+\d{8})$|^(?:(?:0\d{2,3})-)?(?:\d{7,8})(-(?:\d{3,}))?$/', '联系电话格式不正确！', 2, 'regex', 3),
		array('shop_type', 'require', '店铺类型不能为空！', 1, 'regex', 3),
		array('shop_type', 'number', '店铺类型必须是一个整数！', 1, 'regex', 3),
	);
	public function search($pageSize = 20)
	{
		/**************************************** 搜索 ****************************************/
		$where = array();
		if($shop_name = I('get.shop_name'))
			$where['shop_name'] = array('like', "%$shop_name%");
		if($shop_type = I('get.shop_type'))
			$where['shop_type'] = array('eq', $shop_type);
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