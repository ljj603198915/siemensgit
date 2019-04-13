<?php
namespace Admin\Controller;
use Tools\AdminController;
class ImageTextController extends AdminController
{

    public function lst()
    {
    	$model = D('ImageText');
    	$data = $model->search();
    	$this->assign(array(
    		'data' => $data['data'],
    		'page' => $data['page'],
    	));

		// 设置页面中的信息
		$this->assign(array(
			'_page_title' => '图文消息',
			'_page_btn_link' => U('add'),
		));
    	$this->display();
    }
    public function get_imagetext(){
        $weichatobj = new \Org\Util\Weichat;
        $model = D('Image_text');
        $begin_date = I('post.begin_date');
        if(strtotime($begin_date)>time()||empty($begin_date)){
            echo 1;//日期不正确
            exit;
        }
        $res=$weichatobj->getArticletotal($begin_date,$begin_date); //只能获得图文发出后七天内的数据
        if($res==false){
            for($i=0;$i<10;$i++){
                $data=$weichatobj->getArticletotal($begin_date,$begin_date);
                if($data!=false){
                    $i=10;
                }
            }
        }
        if($res==false){
            echo 3; //接口调用超频，或者失败
            exit;
        }
        //将该接口当天调用的次数存到数据库
        $apimodel=D('weichat_api');
        $api_info=$apimodel->where(array('name'=>'图文接口','datetime'=>date('Y-m-d',time())))->find();
        if($api_info){
            $apimodel->where(array('name'=>'图文接口','datetime'=>date('Y-m-d',time())))->save(array('count'=>$api_info['count']+1));
        }else{
            $apimodel ->add(array('name'=>'图文接口','count'=>1,'datetime'=>date('Y-m-d',time())));
        }
        $api_info=$api_info['count']+1;//今天的调用次数
        if(empty($res['list'])){
            echo 4; //目前无数据
            exit;
        }

        foreach($res['list']as$k=>$v){
            $data[$k]['msgid']=$v['msgid'];
            $data[$k]['title']=$v['title'];
            $details = $v['details']; //二维数组
            $data[$k]['int_page_read_count']=$details[count($details)-1]['int_page_read_count'];
            $data[$k]['share_count']=$details[count($details)-1]['share_count'];
            $data[$k]['datetime']=$details[count($details)-1]['stat_date'];
        }

        foreach($data as$k=>$v){
            $model->where(array('msgid'=>$v['msgid']))->delete();
           if( $model->add($v)==false){
               echo 2; //数据拉取出错请重新拉取
               exit;
           }
        }
        echo 0;//插入成功



    }
    public function delete()
    {
        $model = D('Image_text');
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
}