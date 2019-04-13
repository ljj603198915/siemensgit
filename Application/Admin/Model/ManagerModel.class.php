<?php
namespace Admin\Model;
use Think\Model;
class ManagerModel extends Model {
    protected $insertFields = array('admin_name','admin_pwd','admin_pwd2',);
    protected $updateFields = array('id','admin_name','admin_pwd');
    // 添加和修改会员时使用的表单验证规则
    protected $_validate = array(
        array('admin_name', 'require', '用户名不能为空！', 1, 'regex', 3),
        array('admin_name', '1,30', '用户名的值最长不能超过 30 个字符！', 1, 'length', 3),
        // 第六个参数：规则什么时候生效： 1：添加时生效 2：修改时生效 3：所有情况都生效
        array('admin_pwd', 'require', '密码不能为空！', 1, 'regex', 1),
        array('admin_pwd', 'check_pwd', '密码不能有空格！', 1, 'callback', 3),
        array('admin_pwd2', 'admin_pwd', '两次密码输入不一致！', 1, 'confirm', 1),
        array('admin_name', '', '用户名已经存在！', 1, 'unique', 1),
    );
	function CheckNamePwd($nm,$pwd){
		$info=$this->where("admin_name='$nm'")->find();
		if($info){
			if($info['admin_pwd']===md5($pwd))
				return $info;
		}

   return null;
		
	}
	function check_pwd($pwd){
	    if(preg_match('/\s/',$pwd)){
	        return false;
        }else{
            return true;
        }
    }

    public function search($pageSize = 20)
    {
        /**************************************** 搜索 ****************************************/

        /************************************* 翻页 ****************************************/
        $count = $this->alias('a')->count();
        $page= new \Org\Util\MyPage($count,$pageSize);
        // 配置翻页的样式
        $page->setConfig('prev', '上一页');
        $page->setConfig('next', '下一页');
        $data['page'] = $page->show();
        /************************************** 取数据 ******************************************/
        $data['data'] = $this->alias('a')->group('a.id')->limit($page->firstRow.','.$page->listRows)->select();
        return $data;
    }

	public function _before_insert(&$data,$option){
        $data['admin_pwd']= str_replace(' ','',$data['admin_pwd']);
        $data['admin_pwd'] = md5($data['admin_pwd']);
        $data['admin_rank']='100';
        $data['admin_rank_name']='普通管理员';
        $data['role_id']='2';
    }

    public function _before_update(&$data,$option){
        $data['admin_pwd'] = md5($data['admin_pwd']);
    }
}

   
