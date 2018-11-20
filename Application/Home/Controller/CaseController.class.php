<?php
/**
 * Created by PhpStorm.
 * User: wei
 * Date: 2018/11/11
 * Time: 19:59
 */
namespace Home\Controller;

use Think\Controller;

class CaseController extends Controller
{
    public $case = null;

    public function __construct(){
        $this->case = M('case');
    }

    public function getCaseList(){
        $page = $_GET['page'];
        $limit = $_GET['limit'];
        $hourse = $_GET['hourse'];
        $style = $_GET['style'];
        $area = $_GET['area'];

       $where = '';

        $w = array();

        if ($hourse != "全部"){
            $w['hourse'] = $hourse;
        }
        if($style != "全部"){
            $w['style'] = $style;
        }
        if($area != "全部"){
            $w['area'] = $area;
        }



        $total = $this->case->where($w)->count();

        $data = $this->case
            ->field('id,title,village,style,hourse,designer,area,cover,status,create_time')
            ->order('id desc')
            ->limit(($page-1)*$limit, $limit)
            ->where($w)
            ->where('status = 1')
            ->select();
//        $data['total'] = $total;
        echo returnSuccess('查询成功',$data,$total);
    }
    /**
     * 根据id查询具体的case所有信息
     * @param $id
     */
    public function getCaseById(){
/*
        header("Access-Control-Allow-Origin:*");//注意修改这里填写你的前端的域名
        header("Access-Control-Allow-Headers:DNT,X-Mx-ReqToken,Keep-Alive,User-Agent,X-Requested-With,If-Modified-Since,Cache-Control,Content-Type,Authorization,SessionToken");
        header('Access-Control-Allow-Methods: GET, POST, PUT,DELETE');*/

        $id = $_GET['id'];

        $data = $this->case->where("id=$id")->find();
        $data['cover'] = picture_base64($data['cover']);
        echo returnSuccess('查询成功',$data);
    }

    public function test(){
        echo "wei";
    }

}