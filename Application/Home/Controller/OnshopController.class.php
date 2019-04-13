<?php
namespace Home\Controller;
use Tools\HomeController;
class OnshopController extends HomeController {
    public function onshop()
    {
        $shop_data=D('Onshop')->select();
      // pp($shop_data);
       $this->assign('shop_data',$shop_data);

        $this->display();
    }
}