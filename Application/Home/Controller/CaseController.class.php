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



        $total = $this->case->count();

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

    public function test(){
        echo "wei";
    }

}