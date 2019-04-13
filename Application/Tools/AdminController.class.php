<?php
namespace Tools;
use Think\Controller;
class AdminController extends Controller {
	function __construct(){
    parent::__construct();
          if(!isset($_SESSION['admin_id'])){
              if(CONTROLLER_NAME != 'Manager'){
//                  $this->error('请先登录',U("Manager/login"),1);
                  redirect(U("Manager/login"), 1, '页面跳转中...');
                  //echo '<script>parent.location.href="http://www.wawechat.siemens.com.cn/index.php/Admin/Manager/login"</script>';
              }
          }


	}
   
    
}