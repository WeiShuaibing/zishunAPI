<?php
/**
 * Created by PhpStorm.
 * User: wei
 * Date: 2018/11/1
 * Time: 21:10
 */

/**
 *
 * 返回成功的json数据
 */
function retuenSuccess($msg="" , $data=array()){
    if(empty($data)){
        $result = array(
            'code' => '500',
            'msg' => $msg,
        );
        return json_encode($result);
    }else{
        $result = array(
            'code' => '200',
            'msg'  => $msg,
            'data' => $data
        );
        return json_encode($result);
    }
}

/**
 *
 * 返回失败的数据
 */
function returnError($msg=""){
    $result=array(
        'code'=>'500',
        'msg'=>$msg,
    );
    return json_encode($result);
}
