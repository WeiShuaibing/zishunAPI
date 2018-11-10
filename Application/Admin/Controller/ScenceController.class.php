<?php
/**
 * Created by PhpStorm.
 * User: wei
 * Date: 2018/11/7
 * Time: 11:57
 */

namespace Admin\Controller;


use Think\Controller;

class ScenceController extends Controller
{
    public $scence = null;

    public function __construct()
    {
        $this->scence = M('scence');
    }

    /**
     * 添加实景展示的内容
     */
    public function addScence(){
        $request_data = file_get_contents('php://input');
        $res = json_decode($request_data,true);
        $_POST = $res;
        $_POST['cover'] = change_picture($res['cover'],"Public/upload/scence/");

        if($this->scence->create()){
            $result = $this->scence->add();
            if($result){
                $da = array(
                    'effectRow' => $result
                );
                echo returnSuccess('数据提交成功 ！！！',$da);
            }else{
                echo returnError('数据提交失败！！！');
            }
        }else{
            echo returnError('数据获取失败！！！');
        }
    }

    /**
     * 查询所有的实景展示
     */
    public function getScenceList(){
        $data = $this->scence->field('id,title,url,status,create_time')->order('create_time desc')->select();
        echo returnSuccess('查询成功',$data);
    }

    /**
     * 根据id删除实景
     */
    public function delScenceById(){

        $id = $_GET['id'];

        $effectRow = $this->scence->where("id=$id")->delete();

        $data = array('effectRow'=>$effectRow);
        echo returnSuccess('删除成功！！！',$data);
    }

    public function getScenceById(){
        $id = $_GET['id'];
        $data = $this->scence->where("id=$id")->find();
        if($data){
            $data['cover'] = picture_base64($data['cover']);
            echo returnSuccess('查询成功',$data);
        }else{
            echo returnError('查询失败');
        }
    }

    public function updateScence(){
        $request_data = file_get_contents('php://input');
        $res = json_decode($request_data,true);
        $_POST = $res;
        $_POST['cover'] = change_picture($res['cover']);
        $scence = $this->scence;
        $effectRow = $scence->data($_POST)->save();
        if($effectRow){
            $da = array(
                'effectRow' =>$effectRow
            );
            echo returnSuccess('数据更新成功 ！！！',$da);
        }else {
            echo returnError('数据更新失败！！！');
        }
    }

}