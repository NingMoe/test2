<?php 
header('Content-Type:text/html;charset=utf-8');

$secret='f8607957de83b36867d2d6760d306687';
$data=array('api_key'=>'d4e5de80103c57294e7081f483c4ec99');

$host='http://shanzun3.wx.hostadm.net/ecsapi/';// 测试
$user_id='191';// 测试
$user_id='174';// 测试 hunuo_dz

$host='http://shanzun.com/ecsapi/';// 本地
// $user_id='83';// 本地
$user_id='84';// 本地
// // $supplier_id='25'; // 店铺id
// $user_id='9';// 本地
// $supplier_id='31'; // 店铺id

// 首页 
// $url = $host.'index.php';
// $data=array_merge($data,array(
//     'act'=>'get_index',
//     'user_id'=>$user_id, //会员id
//     'supplier_id'=>$supplier_id, //会员id
// ));


// 会员
$url = $host.'user.php';
// 登陆
$data=array_merge($data,array(
    'act'=>'act_login',
    'username'=>'hunuo_1', //用户名
    'username'=>'hunuo_dz', //用户名
    'username'=>'15915741227', //用户名
    'password'=>'123456', //密码
));
// 会员中心
// $data=array_merge($data,array(
//     'act'=>'get_user_default',
//     'user_id'=>$user_id, //会员id
// ));
// 我的订单
// $data=array_merge($data,array(
//     'act'=>'order_list',
//     'user_id'=>$user_id, //会员id
//     // 'composite_status'=>'100', // 订单状态 100：待付款；101：待发货；102：待收货；104：已完成
//     // 'page'=>'', 
// ));
// 订单详情
// $data=array_merge($data,array(
//     'act'=>'order_detail',
//     'user_id'=>$user_id, //会员id
//     'order_id'=>282, //订单id
// ));
// 取消订单
// $data=array_merge($data,array(
//     'act'=>'cancel_order',
//     'user_id'=>$user_id, //会员id
//     'order_id'=>285, //订单id
// ));
// 我的收货地址
// $data=array_merge($data,array(
//     'act'=>'address_list',
//     'user_id'=>$user_id, //会员id
// ));
// 删除收货地址
// $data=array_merge($data,array(
//     'act'=>'drop_consignee',
//     'user_id'=>$user_id, //会员id
//     'address_id'=>'73', //收货地址id
// ));
// 添加或编辑收货地址
// $data=array_merge($data,array(
//     'act'=>'act_edit_address',
//     'user_id'=>$user_id, //会员id
//     'address_id'=>'73', //收货地址id（修改的时候传）
//     'country'=>'1', //国家id 中国为1
//     'province'=>'6', //省id
//     'city'=>'76', //市id
//     'district'=>'698', //区id
//     'address'=>'详细地址详细地址3333', //详细地址
//     'consignee'=>'小明2', //收货人
//     'mobile'=>'13420246245', //手机号码
// ));
// 设置默认收货地址
// $data=array_merge($data,array(
//     'act'=>'act_address_default',
//     'user_id'=>$user_id, //会员id
//     'id'=>'72', //收货地址id
// ));


// 分类 
// $url = $host.'category.php';
// $data=array_merge($data,array(
//     'act'=>'getcat',
//     'supplier_id'=>$supplier_id, //会员id
// ));
// $data=array_merge($data,array(
//     'act'=>'get_goods',
//     'user_id'=>$user_id, //会员id
//     'supplier_id'=>$supplier_id, //店铺id
//     'cat_id'=>'', //分类id
//     'intro'=>'new', //新品 new /爆款 hot 
//     'sort'=>'last_update', //last_update（最新） shop_price（价格）/salenum(销量) click_count(人气)
//     'order'=>'DESC', //ASC（顺序排列），DESC（倒叙排列）
//     'keywords'=>'', // 关键字
//     'page'=>'1', //页数
// ));


//购物车
// $url = $host.'cart.php';
// // // // 获取购物车信息
// $data=array_merge($data,array(
//     'act'=>'get_cart',
//     'user_id'=>$user_id, //会员id
// ));
// 添加购物车
// $data=array_merge($data,array(
//     'act'=>'addcart',
//     'user_id'=>$user_id, //会员id
//     // 'goods_id'=>'415', //商品id 有货号
//     // 'spec'=>'725,726', //商品属性
//     'goods_id'=>'445', //商品id 有货号
//     'spec'=>'919,921', //商品属性
//     // 'goods_id'=>'478', //商品id 有货号
//     // 'spec'=>'1333,1335', //商品属性
//     'goods_id'=>'485', //商品id 有货号
//     'spec'=>'1382', //商品属性
//     'number'=>1, //购买数量
//     // 'one_step_buy'=>'1', //点击立即购买的时候传 固定值 1 ；
//     'quick'=>'1', //有属性传1，没有属性传0
// ));
// 修改购物车数量/价格
// $data=array_merge($data,array(
//     'act'=>'update_group_cart',
//     'user_id'=>$user_id, //会员id
//     'rec_id'=>922, //所修改记录的id
//     'rec_id'=>265, //所修改记录的id
//     // 'goods_id'=>445, //商品id
//     // 'supplier_id'=>25, //店铺id
//     // 'number'=>3, //数量
//     'goods_id'=>485, //商品id
//     'goods_id'=>513, //商品id
//     'supplier_id'=>33, //店铺id
//     'number'=>3, //数量
//     'goods_price'=>100, //价格
// ));
// 清空购物车
// $data=array_merge($data,array(
//     'act'=>'clear',
//     'user_id'=>$user_id, //会员id
// ));
// 删除购物车指定信息
// $data=array_merge($data,array(
//     'act'=>'delete_cart',
//     'user_id'=>$user_id, //会员id
//     'id'=>'876', //购物车记录id
// ));


//商品详情
$url = $host.'goods.php';
// 获取购物车信息
$data=array_merge($data,array(
    'act'=>'goodsedit',
    'user_id'=>$user_id, //会员id
    'goods_id'=>'415', //会员id
));


// flow.php
// $url = $host.'flow.php';
// // // 购物车结算页面
// $data=array_merge($data,array(
//     'step'=>'checkout',
//     'user_id'=>$user_id, //会员id
//     'sel_cartgoods'=>'924', //选择需要结算的rec_id（，号隔开）
// ));
// // 订单结算页面，提交订单
// $data=array_merge($data,array(
//     'step'=>'done',
//     'user_id'=>$user_id, //会员id
//     'payment'=>'1', //payment（支付方式id）
//     'freight'=>'10', //运费
//     // 'is_pickup'=>'1', //自提填1 默认不传
//     // 'sel_cartgoods'=>'907', //购物车id
//     'province'=>'6', //省id
//     'city'=>'76', //市id
//     'district'=>'698', //区id
//     'address'=>'详细地址详细地址3333', //详细地址
//     'consignee'=>'小明2', //收货人
//     'mobile'=>'13420246245', //手机号码
// ));
// // 订单结算页面，改变收货方式
// $data=array_merge($data,array(
//     'step'=>'select_shipping',
//     'user_id'=>$user_id, //会员id
//     'recid'=>'', //配送方式id
//     'suppid'=>'', //店铺id
// ));


// // region.php
// $url = $host.'region.php';
// // echo $url;die;
// // 地区列表
// $data=array_merge($data,array(
//     'type'=>'2', //类型 1：国家（查省）2：省（查市）3市（查区）
//     'parent'=>'3', //地区id 国家只要中国，id为1
// ));
    

//参数拼凑
$get=array();
if(strpos($url,'?') !== false){
    foreach(explode('&',substr($url,strpos($url,'?')+1)) as $v){
        $tem=explode('=',$v);
        $get[$tem['0']]=$tem['1'];
    }
}
$data['api_sign']=_getSign($secret,array_merge($get,$data));
$back=https_request($url,$data);
        
print_r($back);
die();
/* 公司接口验证用 */
function _getSign($secret, $param)
{
    $token = $secret;
    $token .= _loopArrayToken($param);
    $token .= $secret;
    // $token = strtoupper(md5(urlencode($token)));
    $token = strtoupper(md5($token));
    return $token;
}
function _loopArrayToken($param){
    $token = "";
    ksort($param);
    foreach($param as $k=>$v){
        if ($k=='headimg'||$k=='face_card'||$k=='back_card'||$k=='video'||$k=='images0'||$k=='images1'||$k=='visa'||$k=='proof_residence'||$k=='location_verification') continue;
        if(is_array($v)){
            $token .="{$k}";
            $token .= _loopArrayToken($v);
        }else{
            $token .= "{$k}{$v}";
        }
    }
    return stripslashes($token);
}
/**
 * http请求  模拟登陆
 * @ $url    请求的地址
 * @ $data   发送的参数
 */
function https_request($url,$data = '',$ssl=false,$referer=false){
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url); // 要访问的网址
    if($ssl=== true)curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    if($referer)curl_setopt($curl, CURLOPT_REFERER, $referer);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);  // 设置不直接打印
    if($data!==''){
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    }
    $hear_arr=array('User-Agent:Firefox',"application/x-www-form-urlencoded;charset=utf-8");
    curl_setopt($curl, CURLOPT_HTTPHEADER,$hear_arr);
    $output=curl_exec($curl);  // 执行
    if(curl_errno($curl))$output= 'Curl error: '.curl_error($curl);
    curl_close($curl);  // 关闭
    return $output;
}
?>