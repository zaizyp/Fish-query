<?php
namespace app\index\controller;


class Admin extends Base{
    //管理界面
    function index(){
        //判断用户是否登录
        $uid = session('name');
        if($uid == null){
            $this->redirect('Index/login','请先登录后操作');
        }
        //获取全部鱼类信息
        $list = db('fish')->paginate(7);
        $page = $list->render();
        if($list){
            $this->assign('list',$list);
        }
        $this->assign('page', $page);
        $this->assign('uid', $uid);
        return $this->fetch();
    }

    //登录
    function login()
    {
        $param = $this->request->param();//获取提交过来的用户名和密码

        $admin = db('admin')->where('name', $param['username'])->find();//查询该管理员id在数据库中的记录
        if ($admin) {
            if ($admin['password'] == $param['password']) {
                session('user', $admin);
                session('name', $admin['name']);
                $url = url("index/admin/index");
                exit(json_encode(array('status' => 1, 'url' => $url)));
            }
            exit(json_encode(array('status' => 0, 'msg' => '密码错误')));
        } else {
            exit(json_encode(array('status' => 0, 'msg' => '该用户不存在')));
        }
    }

    //退出登录
    function shutDown(){
        session('name', null);
        session(null, 'fq');
        $this->redirect('Index/index','退出');

    }

    //添加鱼类信息
    function add()
    {
        //获取提交过来的鱼类信息
        $fish = json_decode($this->request->param('fish'), true);
        //查询数据库中是否已经有该鱼的记录
        $db = db('fish');

        $result = $db->where('name', $fish['name'])->find();
        if (!$result) {
            $db->insert($fish);
            $url = url("index/admin/index");
            exit(json_encode(array('status' => 1, 'url' => $url)));
        } else {
            exit(json_encode(array('status' => 0, 'msg' => '该名称的鱼已存在，请勿重复添加！')));
        }
    }

    //更新鱼类信息
    function edit()
    {
        //获取提交过来的鱼类信息，并转换为数组格式
        $fish = json_decode($this->request->param('fish'), true);

        $db = db('fish');
        //查询数据库中是否存在该id值的鱼类记录
        $result = $db->where('id', $fish['id'])->find();
        if ($result) {
            $db->where('id', $fish['id'])->update($fish);
            exit(json_encode(array('status' => 1, 'msg' => '修改成功')));
        } else {
            exit(json_encode(array('status' => 0, 'msg' => '数据库中不存在此鱼类信息，不能直接更新！')));
        }
    }

    //删除鱼类信息
    function del()
    {
        $id = $this->request->param('id');
        $db = db('fish');
        //查询数据库中是否存在该id值的鱼类记录
        $result = $db->where('id', $id)->find();
        if ($result) {
            $db->where('id', $id)->delete();
            exit(json_encode(array('status' => 1, 'msg' => '删除成功')));
        } else {
            exit(json_encode(array('status' => 0, 'msg' => '数据库中不存在此鱼类信息，不能被删除！')));
        }
    }

    //搜索鱼类信息
    function search()
    {
        $name = trim($this->request->param('sName'));
        $class = trim($this->request->param('sClas'));
        $list = '';
        if ($name != '' && $class != '') {
            $list = db('fish')->where(['name' => $name, 'class' => $class])->paginate(7);;
        } else {
            if ($class == '' && $name == '') {
                $list = db('fish')->paginate(7);;
            } else if ($name != '') {
                $list = db('fish')->where('name', $name)->paginate(7);;
            } else {
                $list = db('fish')->where('class', $class)->paginate(7);;
            }
        }
        $this->assign('list', $list);
        $uid = session('name');
        $page = $list->render();
        $this->assign('page', $page);
        $this->assign('uid', $uid);
        return $this->fetch('index');
    }

    //管理员界面
    function admin()
    {
        //判断当前登录用户是否为超级管理员
        $uid = session('name');
        if ($uid != "admin") {
            $this->redirect('Index/login', '您不是超级管理员');
        }
        //获取全部用户信息
        $list = db('admin')->select();
        if ($list) {
            $this->assign('list', $list);
        }
        $this->assign('uid', $uid);
        return $this->fetch();
    }

    //更新用户信息
    function edit_user()
    {
        //获取提交过来的鱼类信息，并转换为数组格式
        $user = json_decode($this->request->param('user'), true);

        $db = db('admin');
        //查询数据库中是否存在该id值的鱼类记录
        $result = $db->where('id', $user['id'])->find();
        if ($result) {
            $db->where('id', $user['id'])->update($user);
            exit(json_encode(array('status' => 1, 'msg' => '修改成功')));
        } else {
            exit(json_encode(array('status' => 0, 'msg' => '数据库中不存在此用户信息，不能直接更新！')));
        }
    }

    //添加用户信息
    function add_user()
    {
        //获取提交过来的鱼类信息
        $user = json_decode($this->request->param('user'), true);
        //查询数据库中是否已经有该鱼的记录
        $db = db('admin');

        $result = $db->where('name', $user['name'])->find();
        if (!$result) {
            $db->insert($user);
            $url = url("index/admin/admin");
            exit(json_encode(array('status' => 1, 'url' => $url)));
        } else {
            exit(json_encode(array('status' => 0, 'msg' => '该用户名已存在，请勿重复添加！')));
        }
    }

    //删除鱼类信息
    function del_user()
    {
        $id = $this->request->param('id');
        $db = db('admin');
        //查询数据库中是否存在该id值的鱼类记录
        $result = $db->where('id', $id)->find();
        if ($result) {
            $db->where('id', $id)->delete();
            exit(json_encode(array('status' => 1, 'msg' => '删除成功')));
        } else {
            exit(json_encode(array('status' => 0, 'msg' => '数据库中不存在此鱼类信息，不能被删除！')));
        }
    }


}