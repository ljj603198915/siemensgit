<?php

namespace FootballAdmin\Model;

use Think\Model;

class GameModel extends Model
{
    protected $insertFields = array('name', 'game_time', 'home_team_id', 'guest_team_id',);
    protected $updateFields = array('id', 'name', 'game_time', 'home_team_id', 'guest_team_id');
    protected $_validate = array(
        array('name', 'require', '活动名称不能为空！', 1, 'regex', 3),
        array('name', '1,255', '活动名称的值最长不能超过 255 个字符！', 1, 'length', 3),
        array('game_time', 'require', '比赛时间不能为空！', 1, 'regex', 3),
        array('home_team_id', 'require', '主队不能为空！', 1, 'regex', 3),
        array('home_team_id', 'number', '主队必须是一个整数！', 1, 'regex', 3),
        array('guest_team_id', 'require', '客对不能为空！', 1, 'regex', 3),
        array('guest_team_id', 'number', '客对必须是一个整数！', 1, 'regex', 3),
    );

    public function search($pageSize = 20)
    {
        /**************************************** 搜索 ****************************************/
        $where = array();
        if ($name = I('get.name'))
            $where['name'] = array('like', "%$name%");
        $game_timefrom = I('get.game_timefrom');
        $game_timeto = I('get.game_timeto');
        if ($game_timefrom && $game_timeto)
            $where['game_time'] = array('between', array(strtotime("$game_timefrom 00:00:00"), strtotime("$game_timeto 23:59:59")));
        elseif ($game_timefrom)
            $where['game_time'] = array('egt', strtotime("$game_timefrom 00:00:00"));
        elseif ($game_timeto)
            $where['game_time'] = array('elt', strtotime("$game_timeto 23:59:59"));
        if ($home_team_id = I('get.home_team_id'))
            $where['home_team_id'] = array('eq', $home_team_id);
        if ($guest_team_id = I('get.guest_team_id'))
            $where['guest_team_id'] = array('eq', $guest_team_id);
        if ($results = I('get.results'))
            $where['results'] = array('like', "%$results%");
        /************************************* 翻页 ****************************************/
        $count = $this->alias('a')->where($where)->count();
        $page = new \Think\Page($count, $pageSize);
        // 配置翻页的样式
        $page->setConfig('prev', '上一页');
        $page->setConfig('next', '下一页');
        $data['page'] = $page->show();
        /************************************** 取数据 ******************************************/
        $data['data'] = $this->alias('a')->
        where($where)->group('a.id')->limit($page->firstRow . ',' . $page->listRows)->select();
        foreach ($data as $k=>$v) {
            foreach ($v as $kk=>$vv){
                if(!empty($vv['home_team_id'])){
                    $res = D("Team")->find($vv['home_team_id']);
                    $data[$k][$kk]['home_team_name'] = $res['team_name'];
                }
                if(!empty($vv['guest_team_id'])){
                    $res = D("Team")->find($vv['guest_team_id']);
                    $data[$k][$kk]['guest_team_name'] = $res['team_name'];
                }
            }
        }
        return $data;
    }

    // 添加前
    protected function _before_insert(&$data, $option)
    {
        $data['results'] = "unknown";
    }

    // 修改前
    protected function _before_update(&$data, $option)
    {
    }

    // 删除前
    protected function _before_delete($option)
    {
        if (is_array($option['where']['id'])) {
            $this->error = '不支持批量删除';
            return FALSE;
        }
    }
    /************************************ 其他方法 ********************************************/
}