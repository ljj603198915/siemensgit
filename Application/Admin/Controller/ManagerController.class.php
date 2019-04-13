<?php
namespace Admin\Controller;
use Tools\AdminController;
use Think\Verify;
class ManagerController extends AdminController {
    public function login(){
        $login=new \Admin\Model\ManagerModel();
        if(!empty($_POST)){
            //验证码判断
            $ver=new Verify();
            if($ver->check($_POST['captcha'])){
                $info=$login->CheckNamePwd($_POST['admin_name'],$_POST['admin_pwd']);
                if($info){
                    session('admin_id',$info['id']);
                    session('admin_name',$info['admin_name']);
                    session('admin_rank',$info['admin_rank']);
                    $this->redirect('Index/index');
                }else{
                    echo '<script> alert("用户名密码不一致")</script>';
                }
            }else{
                    echo '<script> alert("验证码错误")</script>';
            }
        }
        $this->display();
    }

    function verifyImg(){
        $conf=array(
            'fontSize'  =>  14,              // 验证码字体大小(px)
            'imageH'    =>  45,               // 验证码图片高度
            'imageW'    =>  100,               // 验证码图片宽度
            'length'    =>  4,               // 验证码位数
            'fontttf'   =>  '4.ttf',              // 验证码字体，不设置随机获取
        );
        $veri=new Verify($conf);
        $veri->entry();

    }
//退出系统并清除缓存
    public function logout(){
        session(null);
        $this->redirect('login');
    }
    public function lst(){

        if($_SESSION['admin_rank'] ==10) {
            $data=D('Manager')->search();
            $this->assign(array(
                'data'=>$data['data'],
                'page'=>$data['page'],
                '_page_title' => '管理员列表',
                '_page_btn_name' => '添加管理员',
                '_page_btn_link' => U('add'),
            ));
            $this->display();
        }else{
            $this->error('无权访问',U("Index/index"));
        }


    }
    public function add(){
        if(IS_POST){
            if($_SESSION['admin_rank'] ==10) {
                $model = D('Manager');
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
        }
        $this->assign(array(
            '_page_title' => '添加管理员',
            '_page_btn_name' => '管理员列表',
            '_page_btn_link' => U('lst'),
        ));
        $this->display();
    }
    public function edit(){
        $id=I('get.id');
        $model=D('Manager');
        if(IS_POST){
            if($_SESSION['admin_rank'] ==10) {
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

        }
        $data=$model->where(array('id'=>$id))->find();
        $this->assign(array(
            'data'=>$data,
            '_page_title' => '修改管理员',
            '_page_btn_name' => '管理员列表',
            '_page_btn_link' => U('lst'),
        ));
        $this->display();
    }
    public function delete(){
        $id=I('get.id');
        if($_SESSION['admin_rank']==10){
            $model=D('Manager');
            if($model->where(array('id'=>$id))->delete()){
                $this->success('删除成功！', U('lst'));
                exit;
            }
            $this->error($model->getError());
        }
    }
    //个人设置
    public function person(){
        $model=D('Manager');
        if(IS_POST){
            if($a=$model->create(I('post.',3))){
                if($model->save()!=false){
                    //layout(false);
                    $this->success('修改成功',U('Manager/person'));
                    exit;
                }else{
                    $this->error('无需修改',U('Manager/person'));
                    exit;
                }
            }
            $this->error($model->getError());

        }
        $data=$model->find($_SESSION['admin_id']);
        $this->assign('data',$data);
        $this->assign(array(
            '_page_title' => '修改个人信息',
        ));
        $this->display();

    }

     public function remember(){
         $username=I('username');
         if(!empty($username)){
             cookie('username',$username,7*24*3600);
         }else{
            pp(setcookie("username", "", time() - 3600)) ;
         }

     }

}


