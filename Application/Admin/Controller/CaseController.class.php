<?php
/**
 * Created by PhpStorm.
 * User: wei
 * Date: 2018/11/1
 * Time: 21:32
 */

namespace Admin\Controller;


use Think\Controller;

class CaseController extends Controller
{
    public $case = null;

    public function __construct(){
        $this->case = M('case');
    }

    /**
     * 根据参数查询一类的所有案例
     * @param $houseFurnishing  户型
     * @param $style    风格
     * @param $area     面积
     */
    public function queryCaseGroup($houseFurnishing='', $style='', $area=''){

    }

    /**
     * 根据id查询具体的case所有信息
     * @param $id
     */
    public function getCaseById($id){
        $data = $this->case->where("id=$id")->find();
        $data['cover'] = picture_base64($data['cover']);
        echo returnSuccess('查询成功',$data);
    }

    /**
     * 获取所有的实例信息
     */
    public function getCaseList(){
        $page = $_GET['page'];
        $limit = $_GET['limit'];

        $total = $this->case->count();

        $data = $this->case
            ->field('id,title,village,style,hourse,designer,area,status,create_time')
            ->order('id desc')
            ->limit(($page-1)*$limit, $limit)
            ->select();
//        $data['total'] = $total;
        echo returnSuccess('查询成功',$data,$total);
    }

    /**
     * 根据id删除实例
     */
    public function deleteCaseById(){

        $id = $_GET['id'];

        $effecrRow = $this->case->where("id = $id") -> delete();

        $data = array('effectRow'=>$effecrRow);
        echo returnSuccess("删除成功！！！",$data);
    }

    /**
     * 将前台传来的case信息添加至数据库中
     */
    public function addCase(){
        $request_data = file_get_contents('php://input');
        $res = json_decode($request_data,true);
        $_POST = $res;
        $_POST['cover'] = change_picture($res['cover'],"Public/upload/case/");
        $case = $this->case;
        if($case->create()){
            $result = $case->add();
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
     * 更新文章
     */
    public function updateCase(){
        $request_data = file_get_contents('php://input');
        $res = json_decode($request_data,true);
        $_POST = $res;
        $_POST['cover'] = change_picture($res['cover']);
        $case = $this->case;
        $effectRow = $case->data($_POST)->save();
        if($effectRow){
            $da = array(
                'effectRow' =>$effectRow
            );
            echo returnSuccess('数据更新成功 ！！！',$da);
        }else {
            echo returnError('数据更新失败！！！');
        }
    }

    // ========================================================================

    public function test(){
        echo picture_base64("Public/upload/1541767644.png");
    }




}