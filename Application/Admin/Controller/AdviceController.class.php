<?php
namespace Admin\Controller;
use Think\Controller;
class AdviceController extends Controller 
{
//    public function add()
//    {
//    	if(IS_POST)
//    	{
//    		$model = D('Advice');
//    		if($model->create(I('post.'), 1))
//    		{
//    			if($id = $model->add())
//    			{
//    				$this->success('添加成功！', U('lst?p='.I('get.p')));
//    				exit;
//    			}
//    		}
//    		$this->error($model->getError());
//    	}
//
//		// 设置页面中的信息
//		$this->assign(array(
//			'_page_title' => '添加',
//			'_page_btn_name' => '列表',
//			'_page_btn_link' => U('lst'),
//		));
//		$this->display();
//    }
//    public function edit()
//    {
//    	$id = I('get.id');
//    	if(IS_POST)
//    	{
//    		$model = D('Advice');
//    		if($model->create(I('post.'), 2))
//    		{
//    			if($model->save() !== FALSE)
//    			{
//    				$this->success('修改成功！', U('lst', array('p' => I('get.p', 1))));
//    				exit;
//    			}
//    		}
//    		$this->error($model->getError());
//    	}
//    	$model = M('Advice');
//    	$data = $model->find($id);
//    	$this->assign('data', $data);
//
//		// 设置页面中的信息
//		$this->assign(array(
//			'_page_title' => '修改',
//			'_page_btn_name' => '列表',
//			'_page_btn_link' => U('lst'),
//		));
//		$this->display();
//    }
//    public function delete()
//    {
//    	$model = D('Advice');
//    	if($model->delete(I('get.id', 0)) !== FALSE)
//    	{
//    		$this->success('删除成功！', U('lst', array('p' => I('get.p', 1))));
//    		exit;
//    	}
//    	else
//    	{
//    		$this->error($model->getError());
//    	}
//    }
    public function lst()
    {
    	$model = D('Advice');
    	$data = $model->search();
    	$this->assign(array(
    		'data' => $data['data'],
    		'page' => $data['page'],
    	));

		// 设置页面中的信息
		$this->assign(array(
			'_page_title' => '列表',
			'_page_btn_name' => '添加',
			'_page_btn_link' => U('add'),
		));
    	$this->display();
    }
    public function handle(){
        $id = I("id");
        $model = D('advice');
        $lowShopData = $model ->find($id);
        $lowShopData["status"] = 1;
        $lowShopData['handle_time'] = date("Y-m-d H:i:s");
        if($model->save($lowShopData) !== FALSE)
        {
            $this->success('处理成功！', U('lst', array('p' => I('get.p', 1))));
            exit;
        }

    }
}