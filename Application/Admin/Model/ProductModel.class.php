<?php
namespace Admin\Model;
use Think\Model;
use Org\Util;
class ProductModel extends Model
{
	protected $insertFields = array('product_name','product_show_desc','product_desc','series_id','color_pid','color_id','user_color','cat_id','material_id','type_id','light_id','is_usb','first_cat','second_cat','is_zz_xx');
	protected $updateFields = array('id','product_name','product_show_desc','product_desc','series_id','color_pid','color_id','color_pid','cat_id','material_id','type_id','light_id','is_usb','first_cat','second_cat','is_zz_xx');
	protected $_validate = array(
		array('product_name', '1,255', '产品型号的值最长不能超过 255 个字符！', 2, 'length', 3),
        array('product_name', 'require', '产品型号不能为空！', 1, 'regex', 3),
        array('product_name', '/[a-zA-Z0-9]+/', '产品型号格式不正确！', 2, 'regex', 3),
       // array('product_name', '', '产品型号已存在！', 1, 'unique', 1),
        array('type_id', 'require', '类型不能为空！', 1, 'regex', 3),
        array('product_name', 'require', '产品型号不能为空！', 1, 'regex', 3),
        array('product_show_desc', 'require', '产品描述(全称)不能为空！', 1, 'regex', 3),
		array('product_show_desc', '1,255', '产品描述(全称)的值最长不能超过 255 个字符！', 2, 'length', 3),
        array('product_desc', '1,255', '产品描述的值(简称)最长不能超过 255 个字符！', 2, 'length', 3),
		array('series_id', 'number', '系列必须是一个整数！', 2, 'regex', 3),
        array('color_pid', 'number', '颜色必须是一个整数！', 2, 'regex', 3),
		array('color_id', 'number', '颜色必须是一个整数！', 2, 'regex', 3),
		array('cat_id', 'number', '开关插座和配电产的分类字段必须是一个整数！', 2, 'regex', 3),
		array('material_id', 'number', '材质必须是一个整数！', 2, 'regex', 3),
		array('type_id', 'number', '类型必须是一个整数！', 2, 'regex', 3),
		array('light_id', 'number', '指示灯必须是一个整数！', 2, 'regex', 3),
		array('is_usb', 'number', '是否带usb必须是一个整数！', 2, 'regex', 3),
		array('first_cat', '1,255', '第一分类名称的值最长不能超过 255 个字符！', 2, 'length', 3),
		array('second_cat', '1,255', '第二分类名称的值最长不能超过 255 个字符！', 2, 'length', 3),
		array('is_zz_xx', 'number', '自助选型下的还是了解产品下的 0都是1了解2自助必须是一个整数！', 2, 'regex', 3),
	);
	public function search($pageSize = 20)
	{
		/**************************************** 搜索 ****************************************/
		$where = array();
		if($product_name = I('get.product_name'))
			$where['product_name'] = array('like', "%$product_name%");
//		if($product_desc = I('get.product_desc'))
//			$where['product_desc'] = array('like', "%$product_desc%");
		if($series_id = I('get.series_id'))
			$where['series_id'] = array('eq', $series_id);
		if($color_id = I('get.color_id'))
			$where['color_id'] = array('eq', $color_id);
		if($cat_id = I('get.cat_id'))
			$where['cat_id'] = array('eq', $cat_id);
		if($material_id = I('get.material_id'))
			$where['material_id'] = array('eq', $material_id);
		if($type_id = I('get.type_id'))
			$where['type_id'] = array('eq', $type_id);
		if($light_id = I('get.light_id'))
			$where['light_id'] = array('eq', $light_id);
		if($is_usb = I('get.is_usb'))
			$where['is_usb'] = array('eq', $is_usb);
		if($first_cat = I('get.first_cat'))
			$where['first_cat'] = array('like', "%$first_cat%");
		if($second_cat = I('get.second_cat'))
			$where['second_cat'] = array('like', "%$second_cat%");
//		if($is_zz_xx = I('get.is_zz_xx'))
//			$where['is_zz_xx'] = array('eq', $is_zz_xx);
		/************************************* 翻页 ****************************************/
		$count = $this->alias('a')->where($where)->count();
        $page= new \Org\Util\MyPage($count,$pageSize);
		// 配置翻页的样式
        $page->setConfig('prev', '上一页');
		$page->setConfig('next', '下一页');
        $page->setConfig('first', '首页');
        $page->setConfig('last', '末页');
        $data['page'] = $page->show();
		/************************************** 取数据 ******************************************/
		$data['data'] = $this->
                field('a.*,b.series_name,c.color_name,d.cat_name,e.material_name,f.type_name,g.first_cat_name,h.second_cat_name,i.light_name')->
                alias('a')->
                join('LEFT JOIN __SERIES__ b ON a.series_id=b.id      
		        LEFT JOIN __COLOR__ c ON a.color_id=c.id 
		        LEFT JOIN __CATEGORY__ d ON a.cat_id=d.id 
		        LEFT JOIN __MATERIAL__ e ON a.material_id=e.id
		        LEFT JOIN __TYPE__ f ON a.type_id=f.id 
		        LEFT JOIN __FIRST_CAT__ g ON a.first_cat=g.id 
		        LEFT JOIN __SECOND_CAT__ h ON a.second_cat=h.id
		        LEFT JOIN __LIGHT__ i ON a.light_id=i.id 
		        ' )->
                 where($where)->group('a.id')->limit($page->firstRow.','.$page->listRows)->select();
		return $data;
	}
	//查看某一件商品的具体信息
    public function showProduct($id){
        $data=$this-> field('a.*,b.series_name,c.color_name,d.cat_name,e.material_name,f.type_name,g.first_cat_name,h.second_cat_name,i.light_name')->
                    alias('a')->
                    join('LEFT JOIN __SERIES__ b ON a.series_id=b.id      
                    LEFT JOIN __COLOR__ c ON a.color_id=c.id 
                    LEFT JOIN __CATEGORY__ d ON a.cat_id=d.id 
                    LEFT JOIN __MATERIAL__ e ON a.material_id=e.id
                    LEFT JOIN __TYPE__ f ON a.type_id=f.id 
                    LEFT JOIN __FIRST_CAT__ g ON a.first_cat=g.id 
                    LEFT JOIN __SECOND_CAT__ h ON a.second_cat=h.id
                    LEFT JOIN __LIGHT__ i ON a.light_id=i.id 
                    ' )->where(array('a.id'=>$id))->find();
        return $data;
    }
	// 添加前
	protected function _before_insert(&$data, $option)
	{
//	    $filename=$data['series_id'].$data['product_name'];
//        if(isset($_FILES['product_image']) && $_FILES['product_image']['error'] == 0)
//        {
//            $exits=substr(strrchr($_FILES['product_image']['name'], '.'), 1);
//            unlink( "./Public/Uploads/Product/$filename.$exits" );
//            $ret = uploadOne('product_image', 'Product',$filename,array()
//            );
//            if($ret['ok'] == 1)
//            {
//                $data['product_image'] = $ret['images'][0];
//
//            }
//            else
//            {
//                $this->error = $ret['error'];
//                return FALSE;
//            }
//        }
    }

//	public function _after_insert(&$data, $option){
//	    //var_dump($data);die;
//        // var_dump($data);die;
//        $filename=$data['id'];
//
//        if(isset($_FILES['product_image']) && $_FILES['product_image']['error'] == 0)
//        {
//            //$exits=substr(strrchr($_FILES['product_image']['name'], '.'), 1);
//            //unlink( "./Public/Uploads/Product/$filename.$exits" );
//            $ret = uploadOne('product_image', 'Product',$filename,array()
//            );
//            if($ret['ok'] == 1)
//            {
//                $data['product_image'] = $ret['images'][0];
////                $file=$data["product_image"];
////                $this->where(array('id'=>$filename))->save(array('product_image'=>$data['product_image']));
////                var_dump($this->_sql());die;
////                $this->query(" update si_product set product_image="."'$file'"." where id=$filename");
////                exit;
//
//            }
//            else
//            {
//                $this->error = $ret['error'];
//                return FALSE;
//            }
//        }
//    }
	// 修改前
	protected function _before_update(&$data, $option)
	{
        $filename=$option['where']['id'];
        $filename= (string)($filename);
		if(isset($_FILES['product_image']) && $_FILES['product_image']['error'] == 0)
		{
            $exits=substr(strrchr($_FILES['product_image']['name'], '.'), 1);
            unlink( "./Public/Uploads/Product/$filename.$exits" );
            $ret = uploadOne('product_image', 'Product',$filename,array()
			);
			if($ret['ok'] == 1)
			{
				$data['product_image'] = $ret['images'][0];

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
		$images = $this->field('product_image')->find($option['where']['id']);
		deleteImage($images);
	}
	/************************************ 其他方法 ********************************************/
}