<?php
namespace app\index\controller;


class Admin extends Base{
    function index(){
        $uid = session('admin-id');
        if($uid == null){
            $this->redirect('Index/login','请先登录后操作');
        }
        $list = db('fish')->where('id','>',0)->select();
        if($list){
            $this->assign('list',$list);
        }

        return $this->fetch();
    }
    function shutDown(){
        session('admin-id',null);
        session(null, 'fq');
        $this->redirect('Index/index','退出');
    }
}