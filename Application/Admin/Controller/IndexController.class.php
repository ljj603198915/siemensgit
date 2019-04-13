<?php
namespace Admin\Controller;
use Tools\AdminController;
class IndexController extends AdminController {
    public function index(){
        $admin_id=session('admin_id');
        $admin_name=session('admin_name');
        $infoA=D('Action')->where("action_level=0")->select();
        if($_SESSION['admin_rank']==10){
            $infoB=D('Action')->where("action_level=1")->select();
        }else{
            $role_id=D('Manager')->field('b.action_id')->alias('a')->join('LEFT JOIN __ROLE__ b ON a.role_id =b.id ')->where(array('a.id'=>$_SESSION['admin_id']))->find();
            $infoB=D('Action')->where(array('action_level'=>array('eq',1),'id'=>array('in',$role_id['action_id'])))->select();
        }
        $this->assign("infoA",$infoA);
        $this->assign("infoB",$infoB);
        $admin_name=session('admin_name');
        $this->assign('admin_name',$admin_name);
        $this->display();

    }

//    public function top(){
//
//        $this->display();
//
    //}
    public function main(){
        $this->display();

    }

    public function menu(){
        //查询出角色ID

        }





}