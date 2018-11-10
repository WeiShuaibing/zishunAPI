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
function returnSuccess($msg="" , $data=array(), $other=null){
    if(empty($data)){
        $result = array(
            'code' => 500,
            'msg' => $msg,
        );
//        return $result;
        return json_encode($result);
    }else{
        $result = array(
            'code' => 200,
            'msg'  => $msg,
            'other' => $other,
            'data' => $data
        );
//        return $result;
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


/**
 * 将二进制的流文件保存为图片并且返回图片得路径地址
 * @param $imgs二级制流失格式的图片
 */
function change_picture($imgs,$pa){


    $result = null;
    preg_match('/^(data:\s*image\/(\w+);base64,)/', $imgs, $result);
    $type = $result[2];

    $imgs = substr(strstr($imgs,','),1);
    $imgs= base64_decode($imgs );

    $path = $pa;
//    $path = "Public/upload/";

    if(!is_dir($path)){
        mkdir($path);
    }

    $new_file = "$path".time().'.'.$type; //生成图片名字
    if(!empty($new_file)){
        $file = fopen($new_file,"w");
        fwrite($file,$imgs); //写入
        fclose($file);
    }
    return $new_file;
}

/**
 * 将图片转换为base64字符串
 *
 */
function picture_base64($image_file){
    $base64_image = '';
    $image_info = getimagesize($image_file);
    $image_data = fread(fopen($image_file, 'r'), filesize($image_file));
    $base64_image = 'data:' . $image_info['mime'] . ';base64,' . chunk_split(base64_encode($image_data));
    return $base64_image;
}












