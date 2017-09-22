<?php 
header('Content-Type:text/html;charset=utf-8');
// ini_set("max_execution_time", "18000");
// ini_set("memory_limit", "1000M");
date_default_timezone_set('PRC'); //设置中国时区 
ini_set( 'display_errors', 1 ); // Off
ini_set('max_execution_time', '0');
error_reporting(E_ALL);

// 百度编辑器过滤div等
// 修改ueditor.all.js   allowDivTransToP 为false；

//商家会员修改用户名登陆失败
// 后台 supplier.php
//更新相关店铺的管理员状态需要保存用户手机号
    if(count($info)>0){
        $sql = "UPDATE ". $ecs->table('supplier_admin_user') ." SET user_name = '".$supplier_old['user_name']."',password = '".$supplier_old['password']."',email='".$supplier_old['email']."',ec_salt='".$supplier_old['ec_salt']."', checked = ".intval($_POST['status']).", mobile_phone = ".$supplier_old['mobile_phone']." WHERE supplier_id=".$supplier_old['supplier_id']." and uid=".$supplier_old['user_id'];
        $db->query($sql);
    }else{
        $insql = "INSERT INTO " . $ecs->table('supplier_admin_user') . " (`uid`, `user_name`, `email`, `password`, `ec_salt`, `add_time`, `last_login`, `last_ip`, `action_list`, `nav_list`, `lang_type`, `agency_id`, `supplier_id`, `todolist`, `role_id`, `checked`, `mobile_phone`) ".
            "VALUES(".$supplier_old['user_id'].", '".$supplier_old['user_name']."', '".$supplier_old['email']."', '".$supplier_old['password']."', '".$supplier_old['ec_salt']."', ".$supplier_old['last_login'].", ".$supplier_old['last_login'].", '".$supplier_old['last_ip']."', 'all', '', '', 0, ".$supplier_old['supplier_id'].", NULL, NULL, ".intval($_POST['status']).", ".$supplier_old['mobile_phone'].")";
        $db->query($insql);
    }


// ecshop bug
// 计算运费是购物车内所有商品的运费，并非勾选商品的运费
// 手机版选择发票开头时回调数据问题。
