<?php
namespace Admin\Controller;
use Tools\AdminController;
class ProductController extends AdminController
{
    public function add()
    {
        if(IS_POST)
    	{
    		$model = D('Product');
    		if($model->create(I('post.'), 1))
    		{
    			if($id = $model->add())
    			{
                    if(isset($_FILES['product_image']) && $_FILES['product_image']['error'] == 0)
                    {
                        $ret = uploadOne('product_image', 'Product',$id,array()
                        );
                        if($ret['ok'] == 1)
                        {
                            $data['product_image'] = $ret['images'][0];
                            $file=$data["product_image"];
                            $sql = " update si_product set product_image='$file' where id='$id';";
                            $model->execute($sql);



                        }
                        else
                        {
                            $this->error = $ret['error'];
                            return FALSE;
                        }
                    }
    				$this->success('添加成功！', U('lst?p='.I('get.p')));
    				exit;
    			}
    		}
    		$this->error($model->getError());
    	}
//    	$series=D('series')->select();
        $color_pid_data=D('Color')->where(array('pid'=>0))->select();
//        $cat=D('Category')->select();
//        $first_cat=D('First_cat')->select();
//        $second_cat=D('Second_cat')->select();
//        $material=D('Material')->select();
//        $type=D('Type')->select();
//        $light=D('Light')->select();

		// 设置页面中的信息
//        $this->assign(array(
//            'series'=>$series,
//            'color'=>$color,
//            'cat'=>$cat,
//            'first_cat'=>$first_cat,
//            'second_cat'=>$second_cat,
//            'material'=>$material,
//            'type'=>$type,
//            'light'=>$light
//        ));
        $this->assign('color_pid_data',$color_pid_data);
		$this->assign(array(
			'_page_title' => '添加产品',
			'_page_btn_name' => '产品列表',
			'_page_btn_link' => U('lst'),
		));

		$this->display();
    }
    public function edit()
    {

    	  $id = I('get.id');
//        $series=D('series')->select();
//        $color=D('Color')->select();
//        $cat=D('Category')->select();
//        $first_cat=D('First_cat')->select();
//        $second_cat=D('Second_cat')->select();
//        $material=D('Material')->select();
//        $type=D('Type')->select();
//        $light=D('Light')->select();
    	if(IS_POST)
    	{

    		$model = D('Product');
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
    	$model = M('Product');
    	$data = $model->find($id);
        $color_pid_data = D('Color')->where(array('pid'=>0))->select();
        if($data['color_pid']!=0){
            $color_id_data = D('Color')->where(array('pid'=>$data['color_pid']))->select();
        }
    	$this->assign('data', $data);
        $this->assign('color_pid_data', $color_pid_data);
        $this->assign('color_id_data', $color_id_data);

		// 设置页面中的信息

		$this->assign(array(
			'_page_title' => '修改产品',
			'_page_btn_name' => '产品列表',
			'_page_btn_link' => U('lst'),
		));
		$this->display();
    }
    public function delete()
    {
    	$model = D('Product');
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
    	$model = D('Product');
    	$data = $model->search();
    	$this->assign(array(
    		'data' => $data['data'],
    		'page' => $data['page'],
    	));
        $color_data=D('Color')->where(array('pid'=>array('neq',0)))->select();
        $this->assign('color_data',$color_data);
		// 设置页面中的信息
		$this->assign(array(
			'_page_title' => '产品列表',
			'_page_btn_name' => '添加产品',
			'_page_btn_link' => U('add'),
		));
    	$this->display();
    }
    public function show(){
        $id = I('get.id');
        $model = D('Product');
        $data=$model->showProduct($id);
        $this->assign('data',$data);
        // 设置页面中的信息

        $this->assign(array(
            '_page_title' => '产品详情',
            '_page_btn_name' => '产品列表',
            '_page_btn_link' => U('lst'),
        ));
        $this->display();
    }

    //添加和编辑颜色
    public function color_ajax(){

        $color_id=$_GET['color_pid'];
        if($color_id==0){
            echo json_encode(0);
            exit;
        }
        $jt_color=D('Color')->where(array('pid'=>$color_id))->select();
        echo json_encode($jt_color);
    }
}