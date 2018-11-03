<?php
/**
 * Created by PhpStorm.
 * User: wei
 * Date: 2018/11/1
 * Time: 20:58
 */

namespace Admin\Controller;


use Think\Controller;

class UserController extends Controller{
    public function login(){

        $User = M("user");

        $username = $_POST['username'];
        $password = $_POST['password'];
        if($username!=null && $password!= null){
            $data = $User->where("username=$username and password=$password")->find();
        }else{
            echo returnError('账户或密码错误！！！');
        }
        $res = array(
            'name' => $data['name'],
            'role' => $data['role'],
            'avatar' => $data['avatar']
        );
        if(empty($data)){
            echo returnError('账户或密码错误！！！');
        }else{
            echo retuenSuccess('login success', $res);
        }
    }


    public function index()
    {
        $this->show("<h2>Admin  紫顺官网 + 小程序 后台</2>");
    }




}