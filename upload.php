<?php 
header('Content-Type:text/html;charset=utf-8');
// ini_set("max_execution_time", "18000");
// ini_set("memory_limit", "1000M");
date_default_timezone_set('PRC'); //设置中国时区 
ini_set( 'display_errors', 1 ); // Off
error_reporting(E_ALL);

    if($_FILES){
        $filename = $_FILES['upload']['name'];
          $tmpname = $_FILES['upload']['tmp_name'];
          //保存图片到当前脚本所在目录
          if(move_uploaded_file($tmpname,dirname(__FILE__).'/'.$filename)){
            echo ('上传成功');
          }
    }
    echo "sdf";
exit;
?>