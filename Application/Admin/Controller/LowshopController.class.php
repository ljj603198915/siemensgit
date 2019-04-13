<?php
namespace Admin\Controller;
use Tools\AdminController;
class LowshopController extends AdminController
{
    public function add()
    {
    	if(IS_POST)
    	{
    		$model = D('Lowshop');
    		if($model->create(I('post.'), 1))
    		{
    			if($id = $model->add())
    			{
    				$this->success('添加成功！', U('lst?p='.I('get.p')));
    				exit;
    			}
    		}
    		$this->error($model->getError());
    	}

		// 设置页面中的信息
		$this->assign(array(
			'_page_title' => '添加附近店铺',
			'_page_btn_name' => '附近店铺列表',
			'_page_btn_link' => U('lst'),
		));
		$this->display();
    }
    public function edit()
    {
    	$id = I('get.id');
    	if(IS_POST)
    	{
    		$model = D('Lowshop');
    		if($model->create(I('post.'), 2))
    		{
    			if($model->save() !== FALSE)
    			{
    				$this->success('修改成功！', U('lst', array('p' => I('get.p', 1))));
    				exit;
    			}
    		}
    		$this->error($model->getError());
    	}
    	$model = M('Lowshop');
    	$data = $model->find($id);
    	$this->assign('data', $data);

		// 设置页面中的信息
		$this->assign(array(
			'_page_title' => '修改附近店铺',
			'_page_btn_name' => '附近店铺列表',
			'_page_btn_link' => U('lst'),
		));
		$this->display();
    }
    public function map(){
        $id=I('get.id');
        if(IS_POST){
            $id=I('post.id');
                $model = D('Lowshop');
                $jingweistr= I('post.jingwei');
                $arr=explode(',',$jingweistr);
                $data['longitude']=$arr['0'];
                $data['latitude']=$arr['1'];
                if($model->where(array('id'=>$id ))->save($data) ==1){
                    echo 'success';
                    exit;
                }else{
                    echo 0;
                    exit;
                }
        }
        $this->assign('shop_id',$id);
        $this->display();
    }
    public function delete()
    {
    	$model = D('Lowshop');
    	if($model->delete(I('get.id', 0)) !== FALSE)
    	{
    		$this->success('删除成功！', U('lst', array('p' => I('get.p', 1))));
    		exit;
    	}
    	else 
    	{
    		$this->error($model->getError());
    	}
    }
    public function lst()
    {
    	$model = D('Lowshop');
    	$data = $model->search();
    	$this->assign(array(
    		'data' => $data['data'],
    		'page' => $data['page'],
    	));

		// 设置页面中的信息
		$this->assign(array(
			'_page_title' => '附近店铺列表',
			'_page_btn_name' => '添加附近店铺',
			'_page_btn_link' => U('add'),
		));
    	$this->display();
    }
    public function changeOnSale(){
        $id = I("id");
        $model = D('Lowshop');
        $lowShopData = $model ->find($id);
        if($lowShopData['on_sale'] ==1){
            $lowShopData['on_sale'] =2;
        }elseif ($lowShopData['on_sale'] ==2){
            $lowShopData['on_sale'] =1;
        }
        if($model->save($lowShopData) !== FALSE)
        {
            $this->success('修改成功！', U('lst', array('p' => I('get.p', 1))));
            exit;
        }

    }
}