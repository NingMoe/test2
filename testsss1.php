<?php 
header('Content-Type:text/html;charset=utf-8');
error_reporting(E_ALL);

include('testss.php');
$secret='db4e2e01549ebef835a9f1b89b5b11cf';
$api_key='600300253268ea8b8d687fe1a79a2603';
$host='http://www.xiaojd.cn/ecsapi/';
$host_test='http://xiaojd.com/ecsapi/';

$debug=1; // 测试环境（本地）
$user_id=9;
$api=new ApiControl($secret,$api_key,$host,$host_test,$debug);

/******************************************************index.php*************************************************/
// // 首页
// $data=array(
//     'act'=>'index',
// );

/******************************************************region.php*************************************************/
// // // 获取地区
// $data=array(
//     'act'=>'get_region', // 自定义
//     'type'=>'1',
//     'parent'=>'1',
// );

/******************************************************category.php*************************************************/
// // // 获取分类
// $data=array(
//     'act'=>'getcat',
//     // 'cat_id'=>'362',
// );
// // // 商品列表
// $data=array(
//     'act'=>'get_goods',
//     // 'cat_id'=>'362',
// );

/******************************************************exchange.php*************************************************/
// // // 积分商城列表
// $data=array(
//     'act'=>'get_exchange_list',
//     'goods_id'=>'291',
// );
// // // // 积分商城详情
// $data=array(
//     'act'=>'get_exchange_goods_view',
//     'goods_id'=>'291',
// );
// // // // 积分商城加入购物车
// $data=array(
//     'act'=>'add_exchange_cart',
//     'goods_id'=>'291',
// );

/******************************************************goods.php*************************************************/
// // // 商品详情
// $data=array(
//     'act'=>'goodsedit',
//     'goods_id'=>'291',
// );

/******************************************************cart.php*************************************************/
// // 购物车列表
$data=array(
    'act'=>'get_cart',
    'user_id'=>$user_id,
);
// // // 加入购物车
$data=array(
    'act'=>'addcart',
    'user_id'=>$user_id, //用户id
    'goods_id'=>'293', //商品id
    'number'=>'1', //购买数量
    // 'one_step_buy'=>'1', //点击立即购买的时候传 固定值 1
    'spec'=>'', //商品属性
    'quick'=>'',//有属性传1，没有属性传0
);
// // // 删除购物车指定信息
// $data=array(
//     'act'=>'delete_cart',
//     'user_id'=>$user_id,
//     'goods_id'=>'291',
// );
// // // 清空购物车
// $data=array(
//     'act'=>'clear',
//     'user_id'=>$user_id,
// );
// // // 修改购物车数量
// $data=array(
//     'act'=>'update_group_cart',
//     'user_id'=>$user_id,
//     'goods_id'=>'291',
// );

/******************************************************user.php*************************************************/
// // 会员登陆
// $data=array(
//     'act'=>'act_login',
//     'user_name'=>'test', //会员id
//     'password'=>'123456', //会员id
// );
// // 会员注册
// $data=array(
//     'act'=>'register',
//     'password'=>'123456', //会员id
//     'confirm_password'=>'123456', //会员id
//     'agreement'=>'1', //会员id
//     'mobile_phone'=>'13420246243', //会员id
//     'mobile_code'=>'1', //会员id
// );
// // // 发送验证码
// $data=array(
//     'act'=>'send_message',
//     'phone'=>'13420246245', //会员id
//     'send_type'=>'1', //会员id
// );
// // 获取会员信息
// $data=array(
//     'act'=>'get_user_info',
//     'user_id'=>$user_id, //会员id
// );
// // // 修改个人资料的处理
// $data=array(
//     'act'=>'act_edit_profile',
//     'user_id'=>$user_id, //会员id
// );
// // // 修改头像
// $data=array(
//     'act'=>'act_edit_img',
//     'user_id'=>$user_id, //会员id
// );
// // // 修改会员密码
// $data=array(
//     'act'=>'act_edit_password',
//     'user_id'=>$user_id, //会员id
// );
// // // 找回密码
// $data=array(
//     'act'=>'reset_passwd',
//     'user_id'=>$user_id, //会员id
// );
// // // 我的信息
// $data=array(
//     'act'=>'my_message',
//     'user_id'=>$user_id, //会员id
// );
// // // 我的消息详情
// $data=array(
//     'act'=>'my_message_details',
//     'user_id'=>$user_id, //会员id
// );
// // // 我的消息删除
// $data=array(
//     'act'=>'my_message_del',
//     'user_id'=>$user_id, //会员id
// );
// // // 获取购物车数量
// $data=array(
//     'act'=>'get_cart_count',
//     'user_id'=>$user_id, //会员id
// );
// // 我的订单
// $data=array(
//     'act'=>'order_list',
//     'user_id'=>$user_id, //会员id
// );
// // 订单详情
// $data=array(
//     'act'=>'order_detail',
//     'user_id'=>$user_id, //会员id
//     'order_id'=>34, //订单id
// );
// // 取消订单
// $data=array(
//     'act'=>'cancel_order',
//     'user_id'=>$user_id, //会员id
//     'order_id'=>34, //订单id
// );
// // 确认收货
// $data=array(
//     'act'=>'affirm_received',
//     'user_id'=>$user_id, //会员id
//     'order_id'=>34, //订单id
// );
// 退款退货列表
// $data=array(
//     'act'=>'back_list',
//     'user_id'=>$user_id, //会员id
// );
// // 申请退款退货
// $data=array(
//     'act'=>'back_order',
//     'user_id'=>$user_id, //会员id
//     'order_id'=>204, //订单id
//     'order_all'=>1, //全部
//     // 'goods_id'=>204, //订单id
// );
// // 提交申请退款退货
// $data=array(
//     'act'=>'back_order_act',
//     'user_id'=>$user_id, //会员id
//     'order_id'=>204, //订单id
//     'order_all'=>1, //全部
//     // 'goods_id'=>204, //订单id
// );
// // 收货地址列表
// $data=array(
//     'act'=>'address_list',
//     'user_id'=>$user_id, //会员id
// );
// // // 添加/编辑收货地址
// $data=array(
//     'act'=>'act_edit_address',
//     'user_id'=>$user_id, //会员id
//     'address_id'=>'', //会员id
// );
// // // 删除收货地址
// $data=array(
//     'act'=>'drop_consignee',
//     'user_id'=>$user_id, //会员id
//     'address_id'=>'', //会员id
// );
// // // 设置默认收货地址
// $data=array(
//     'act'=>'act_address_default',
//     'user_id'=>$user_id, //会员id
//     'address_id'=>'', //会员id
// );
// // // 收藏商品列表
// $data=array(
//     'act'=>'collection_list',
//     'user_id'=>$user_id, //会员id
// );
// // // 我的红包列表
// $data=array(
//     'act'=>'bonus',
//     'user_id'=>$user_id, //会员id
// );
// // // 商品评价/晒单
// $data=array(
//     'act'=>'my_comment',
//     'user_id'=>$user_id, //会员id
// );
// // // 提交商品评论
// $data=array(
//     'act'=>'my_comment_send',
//     'user_id'=>$user_id, //会员id
// );

$result=$api->get_dates($data);
print_r($result);
exit;
