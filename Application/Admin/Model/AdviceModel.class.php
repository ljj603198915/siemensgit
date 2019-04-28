<?php
namespace Admin\Model;
use Think\Model;
class AdviceModel extends Model 
{
	protected $insertFields = array('customer_type','advice_name','phone','email','advice_type','advice_content','status','created_time','handle_time');
	protected $updateFields = array('id','customer_type','advice_name','phone','email','advice_type','advice_content','status','created_time','handle_time');
	protected $_validate = array(
		array('customer_type', 'require', '客户类型 1消费者2代理商3公司不能为空！', 1, 'regex', 3),
		array('customer_type', 'number', '客户类型 1消费者2代理商3公司必须是一个整数！', 1, 'regex', 3),
		array('advice_name', 'require', '不能为空！', 1, 'regex', 3),
		array('advice_name', '1,255', '的值最长不能超过 255 个字符！', 1, 'length', 3),
		array('phone', 'require', '不能为空！', 1, 'regex', 3),
		array('phone', '1,255', '的值最长不能超过 255 个字符！', 1, 'length', 3),
		array('email', 'email', '格式不正确！', 2, 'regex', 3),
		array('email', '1,255', '的值最长不能超过 255 个字符！', 2, 'length', 3),
		array('advice_type', 'require', '投诉类型1服务2质量3售假4建议5其他不能为空！', 1, 'regex', 3),
		array('advice_type', 'number', '投诉类型1服务2质量3售假4建议5其他必须是一个整数！', 1, 'regex', 3),
		array('advice_content', 'require', '投诉与建议内容不能为空！', 1, 'regex', 3),
		array('status', 'number', '状态必须是一个整数！', 2, 'regex', 3),
		array('created_time', 'require', '不能为空！', 1, 'regex', 3),
	);
	public function search($pageSize = 20)
	{
		/**************************************** 搜索 ****************************************/
		$where = array();
		if($customer_type = I('get.customer_type'))
			$where['customer_type'] = array('eq', $customer_type);
		if($advice_name = I('get.advice_name'))
			$where['advice_name'] = array('like', "%$advice_name%");
		if($phone = I('get.phone'))
			$where['phone'] = array('like', "%$phone%");
		if($email = I('get.email'))
			$where['email'] = array('like', "%$email%");
		if($advice_type = I('get.advice_type'))
			$where['advice_type'] = array('eq', $advice_type);
		if($advice_content = I('get.advice_content'))
			$where['advice_content'] = array('eq', $advice_content);
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
		if($handle_time = I('get.handle_time'))
			$where['handle_time'] = array('eq', $handle_time);
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
		if(isset($_FILES['img1']) && $_FILES['img1']['error'] == 0)
		{
			$ret = uploadOne('img1', 'Advice', array(
				array(350, 350, 2),
				array(150, 150, 2),
				array(50, 50, 2),
			));
			if($ret['ok'] == 1)
			{
				$data['img1'] = $ret['images'][0];
				$data['big_img1'] = $ret['images'][1];
				$data['mid_img1'] = $ret['images'][2];
				$data['sm_img1'] = $ret['images'][3];
			}
			else 
			{
				$this->error = $ret['error'];
				return FALSE;
			}
		}
		if(isset($_FILES['img2']) && $_FILES['img2']['error'] == 0)
		{
			$ret = uploadOne('img2', 'Advice', array(
				array(350, 350, 2),
				array(150, 150, 2),
				array(50, 50, 2),
			));
			if($ret['ok'] == 1)
			{
				$data['img2'] = $ret['images'][0];
				$data['big_img2'] = $ret['images'][1];
				$data['mid_img2'] = $ret['images'][2];
				$data['sm_img2'] = $ret['images'][3];
			}
			else 
			{
				$this->error = $ret['error'];
				return FALSE;
			}
		}
		if(isset($_FILES['img3']) && $_FILES['img3']['error'] == 0)
		{
			$ret = uploadOne('img3', 'Advice', array(
				array(350, 350, 2),
				array(150, 150, 2),
				array(50, 50, 2),
			));
			if($ret['ok'] == 1)
			{
				$data['img3'] = $ret['images'][0];
				$data['big_img3'] = $ret['images'][1];
				$data['mid_img3'] = $ret['images'][2];
				$data['sm_img3'] = $ret['images'][3];
			}
			else 
			{
				$this->error = $ret['error'];
				return FALSE;
			}
		}
		if(isset($_FILES['img4']) && $_FILES['img4']['error'] == 0)
		{
			$ret = uploadOne('img4', 'Advice', array(
				array(350, 350, 2),
				array(150, 150, 2),
				array(50, 50, 2),
			));
			if($ret['ok'] == 1)
			{
				$data['img4'] = $ret['images'][0];
				$data['big_img4'] = $ret['images'][1];
				$data['mid_img4'] = $ret['images'][2];
				$data['sm_img4'] = $ret['images'][3];
			}
			else 
			{
				$this->error = $ret['error'];
				return FALSE;
			}
		}
		if(isset($_FILES['img5']) && $_FILES['img5']['error'] == 0)
		{
			$ret = uploadOne('img5', 'Advice', array(
				array(350, 350, 2),
				array(150, 150, 2),
				array(50, 50, 2),
			));
			if($ret['ok'] == 1)
			{
				$data['img5'] = $ret['images'][0];
				$data['big_img5'] = $ret['images'][1];
				$data['mid_img5'] = $ret['images'][2];
				$data['sm_img5'] = $ret['images'][3];
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
		if(isset($_FILES['img1']) && $_FILES['img1']['error'] == 0)
		{
			$ret = uploadOne('img1', 'Advice', array(
				array(350, 350, 2),
				array(150, 150, 2),
				array(50, 50, 2),
			));
			if($ret['ok'] == 1)
			{
				$data['img1'] = $ret['images'][0];
				$data['big_img1'] = $ret['images'][1];
				$data['mid_img1'] = $ret['images'][2];
				$data['sm_img1'] = $ret['images'][3];
			}
			else 
			{
				$this->error = $ret['error'];
				return FALSE;
			}
			deleteImage(array(
				I('post.old_img1'),
				I('post.old_big_img1'),
				I('post.old_mid_img1'),
				I('post.old_sm_img1'),
	
			));
		}
		if(isset($_FILES['img2']) && $_FILES['img2']['error'] == 0)
		{
			$ret = uploadOne('img2', 'Advice', array(
				array(350, 350, 2),
				array(150, 150, 2),
				array(50, 50, 2),
			));
			if($ret['ok'] == 1)
			{
				$data['img2'] = $ret['images'][0];
				$data['big_img2'] = $ret['images'][1];
				$data['mid_img2'] = $ret['images'][2];
				$data['sm_img2'] = $ret['images'][3];
			}
			else 
			{
				$this->error = $ret['error'];
				return FALSE;
			}
			deleteImage(array(
				I('post.old_img2'),
				I('post.old_big_img2'),
				I('post.old_mid_img2'),
				I('post.old_sm_img2'),
	
			));
		}
		if(isset($_FILES['img3']) && $_FILES['img3']['error'] == 0)
		{
			$ret = uploadOne('img3', 'Advice', array(
				array(350, 350, 2),
				array(150, 150, 2),
				array(50, 50, 2),
			));
			if($ret['ok'] == 1)
			{
				$data['img3'] = $ret['images'][0];
				$data['big_img3'] = $ret['images'][1];
				$data['mid_img3'] = $ret['images'][2];
				$data['sm_img3'] = $ret['images'][3];
			}
			else 
			{
				$this->error = $ret['error'];
				return FALSE;
			}
			deleteImage(array(
				I('post.old_img3'),
				I('post.old_big_img3'),
				I('post.old_mid_img3'),
				I('post.old_sm_img3'),
	
			));
		}
		if(isset($_FILES['img4']) && $_FILES['img4']['error'] == 0)
		{
			$ret = uploadOne('img4', 'Advice', array(
				array(350, 350, 2),
				array(150, 150, 2),
				array(50, 50, 2),
			));
			if($ret['ok'] == 1)
			{
				$data['img4'] = $ret['images'][0];
				$data['big_img4'] = $ret['images'][1];
				$data['mid_img4'] = $ret['images'][2];
				$data['sm_img4'] = $ret['images'][3];
			}
			else 
			{
				$this->error = $ret['error'];
				return FALSE;
			}
			deleteImage(array(
				I('post.old_img4'),
				I('post.old_big_img4'),
				I('post.old_mid_img4'),
				I('post.old_sm_img4'),
	
			));
		}
		if(isset($_FILES['img5']) && $_FILES['img5']['error'] == 0)
		{
			$ret = uploadOne('img5', 'Advice', array(
				array(350, 350, 2),
				array(150, 150, 2),
				array(50, 50, 2),
			));
			if($ret['ok'] == 1)
			{
				$data['img5'] = $ret['images'][0];
				$data['big_img5'] = $ret['images'][1];
				$data['mid_img5'] = $ret['images'][2];
				$data['sm_img5'] = $ret['images'][3];
			}
			else 
			{
				$this->error = $ret['error'];
				return FALSE;
			}
			deleteImage(array(
				I('post.old_img5'),
				I('post.old_big_img5'),
				I('post.old_mid_img5'),
				I('post.old_sm_img5'),
	
			));
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
		$images = $this->field('img1,big_img1,mid_img1,sm_img1')->find($option['where']['id']);
		deleteImage($images);
		$images = $this->field('img2,big_img2,mid_img2,sm_img2')->find($option['where']['id']);
		deleteImage($images);
		$images = $this->field('img3,big_img3,mid_img3,sm_img3')->find($option['where']['id']);
		deleteImage($images);
		$images = $this->field('img4,big_img4,mid_img4,sm_img4')->find($option['where']['id']);
		deleteImage($images);
		$images = $this->field('img5,big_img5,mid_img5,sm_img5')->find($option['where']['id']);
		deleteImage($images);
	}
	/************************************ 其他方法 ********************************************/
}