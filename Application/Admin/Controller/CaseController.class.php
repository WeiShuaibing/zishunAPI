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

    /**
     * 根据参数查询一类的所有案例
     * @param $houseFurnishing  户型
     * @param $style    风格
     * @param $area     面积
     */
    public function queryCaseGroup($houseFurnishing='', $style='', $area=''){
        $case = M('case');

        $data = $case->find();
    }

    /**
     * 根据id查询具体的case所有信息
     * @param $id
     */
    public function queryCaseById($id){

    }

    /**
     * 将前台传来的case信息添加至数据库中
     */
    public function addCase(){

    }

    // ========================================================================

    /**
     * 将传进来的实景的信息存入数据库中
     */
    public function addRealScene(){

    }

    /**
     * 根据实景 的id号查询实景的所有信息
     * @param $id 实景id号
     */
    public function getRealSceneById($id){

    }

    /**
     * 查询所有的实景信息，用于前台展示
     * 应具有分页功能
     */
    public function getAllRealScene(){

    }




}