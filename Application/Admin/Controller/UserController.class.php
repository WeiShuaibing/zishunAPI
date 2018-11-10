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

        if(isset($_POST['username'])){
            $res = $_POST;
        }else{
            $request_data = file_get_contents('php://input');
            $res = json_decode($request_data,true);
        }
        $User = M("user");

        $username = $res['username'];
        $password = $res['password'];
        if($username!=null && $password!= null){
            $data = $User->where("username=$username and password=$password")->find();
            if(empty($data)){
                echo returnError('账户或密码错误！！！');
            }else{
                $res = array(
                    'name' => $data['name'],
                    'role' => $data['role'],
                    'avatar' => $data['avatar'],
                    'token' => $data['role']
                );
                echo retuenSuccess('login success', $res);
//                $this->ajaxReturn($res,'json');
//                echo json_encode($res);
            }
        }else{
            echo returnError('请输入账户或者密码 ！！！');

        }


    }


    public function index()
    {

       echo 'hello';

    }

    public function info(){
        $res = array(
            'name' => 'wei',
            'avatar' => 'avatar',
            'roles' => 'admin'
        );

        echo retuenSuccess('get user info ',$res);

    }



}