<?php
namespace Admin\Controller;
use Tools\AdminController;
class ActivityController extends AdminController
{
    public function online(){
        $this->error('暂未开通此功能');
    }
    public function offline(){
        $this->error('暂未开通此功能');
    }
}
