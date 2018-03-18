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
        $uid = session('admin-id');
        if(session('?admin-id')&&$uid != null){
            $this->redirect('Admin/index','已登陆');
        }
        if($this->request->isPost()){
            $param = $this->request->param();//获取提交过来的用户名和密码

            $admin = db('admin')->where('admin-id', $param['username'])->find();//查询该管理员id在数据库中的记录
            if($admin){
                if($admin['password']==$param['password']){
                    session('user',$admin);
                    session('admin-id',$admin['admin-id']);
                    $url = url("index/admin/index");
                    exit(json_encode(array('status'=>1,'url'=>$url)));
                }
                exit(json_encode(array('status'=>0,'msg'=>'密码错误')));
            }else{
                exit(json_encode(array('status'=>0,'msg'=>'该用户不存在')));
            }

        }else{
            return $this->fetch();
        }

   }
    public function introduce()
    {
        return $this->fetch();
    }
    public function picture()
    {
        return $this->fetch();
    }
    public function classification()
    {
        return $this->fetch();
    }

}
