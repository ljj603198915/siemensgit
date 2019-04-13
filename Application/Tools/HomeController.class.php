<?php
namespace Tools;
use Think\Controller;
class HomeController extends Controller {
	function __construct(){
    parent::__construct();
        $time=date('Y-m-d');
        $info=D('Statistical')->where(array(
            array('name'=>'H5'),
            array('datetime'=>$time),
        ))->find();
        if($info){
            $data=array('count'=>$info['count']+1);
            D('Statistical')->where(array('id'=>$info['id']))->save($data);
        }else{
            $data=array('name'=>'H5','count'=>1,'datetime'=>$time);
            D('Statistical')->add($data);
        }



	}
   
    
}