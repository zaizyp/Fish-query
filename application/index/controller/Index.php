<?php
namespace app\index\controller;


class Index extends Base
{
    //主页面
    public function index()
    {
        return $this->fetch();
    }
    //登录页面
    public function login()
    {
        $uid = session('name');
        if (session('?name') && $uid != null) {
            $this->redirect('Admin/index','已登陆');
        }
            return $this->fetch();
    }

    public function introduce()
    {
        return $this->fetch();
    }

    //图片查询
    public function picture()
    {
        if ($this->request->param('id')) {
            $fish = db('fish')->where('id', $this->request->param('id'))->find();
            $this->assign('fish', $fish);
            return $this->fetch('information');
        }
        $fish = db('fish')->paginate(9);
        $page = $fish->render();
        $this->assign('page', $page);
        $this->assign('list', $fish);
        return $this->fetch();
    }

    //获取所有鱼的种类
    public function classification()
    {
        $fishs = db('fish')->field('class')->select();
        $class = array();
        foreach ($fishs as $fish) {
            array_push($class, $fish['class']);
        }
        //去除数组里相同种类的信息
        $class = array_unique($class);
        $this->assign('list', $class);
        return $this->fetch();
    }

    //获取种类下面所有的鱼的名称
    public function fishclass()
    {
        $name = db('fish')->where('class', $this->request->param('class'))->field('name')->select();
        return json($name);
    }

    //获取鱼类信息
    public function information()
    {
        $fish = db('fish')->where('name', $this->request->param('name'))->find();
        $this->assign('fish', $fish);
        return $this->fetch();
    }

}
