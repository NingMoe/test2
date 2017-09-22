<?php 
header('Content-Type:text/html;charset=utf-8');
// ini_set("max_execution_time", "18000");
// ini_set("memory_limit", "1000M");
date_default_timezone_set('PRC'); //设置中国时区 
ini_set( 'display_errors', 1 ); // Off
ini_set('max_execution_time', '0');
error_reporting(E_ALL);

//   $serverName = "(local)";
//   $connectionInfo = array("UID"=>"sa","PWD"=>"123456","Database"=>"ReportServer");
//   $conn = sqlsrv_connect( $serverName, $connectionInfo);
//   if( $conn ){
//      echo "Connection established.\n";
//   }else{
//      echo "Connection could not be established.\n";
//      die( var_dump(sqlsrv_errors()));
//   }
//   sqlsrv_close( $conn);
// exit;
// $url='http://zhida.bubaishi.com/bin/FileUpload.dll?uploadpath=B24AAB0D44434963AD4039E1A988F7F8&callbackfun=AddHDCAttach';
// $data['FILE']='@E:\\www\\test\\test.jpg;type=image/jpeg';
// $ss=https_request($url,$data);
// print_r($ss);
// exit;
// // //erp接口
function erpapi($data=array()){
    $url='http://202.105.31.178:83/hsextendinterface.asmx?op=DataSync';
    $url='http://183.238.196.216:83/hsextendinterface.asmx?op=DataSync';
    $url='http://183.238.196.216:83/hsextendinterface.asmx?wsdl'; // 测试
    $url='http://202.105.31.178:83/hsextendinterface.asmx?wsdl'; // 正式
    $c = new SoapClient( $url );
    $data['Token']='@#$dsjfld1sa%d#$3%Ds0d9fB';
    // $data['DataXml']='<materialInfo><row iDataType="1" sMaterialNo="ALL" /></materialInfo>';
    // $data['DataXml']='<materialInfo><row iDataType="1" sMaterialNo="ABC-66" /></materialInfo>';
    // $data['DataXml']='<materialInfo><row iDataType="2" sTypeCode ="sStyle" /></materialInfo>'; // 分类 花型=MatternPattern 1 颜色=ColorName 2 材质=sMaterialQuality 3 风格=sStyle 4 适用范围=sApplicationSpoce
    // $data['DataXml']='<materialInfo><row iDataType="4" sMaterialNo="D-A-34" /></materialInfo>';
    // $data['DataXml']='<materialInfo><row iDataType="4" sMaterialNo="D-A-34" /></materialInfo>';
    // $data['DataXml']='<materialInfo><row iDataType="4" sMaterialNo="'.$goods_sn.'" /></materialInfo>';
    // print_r($data);exit;
    // var_dump( $c->__getFunctions() );
    if($data['DataXml']=='') return false;
    $pr =$c->DataSync($data);
    return $pr->DataSyncResult;
}
// erp接口
// $data['DataXml']='<materialInfo><row iDataType="2" sTypeCode ="MatternPattern" /></materialInfo>';
// $data['DataXml']='<materialInfo><row iDataType="1" sMaterialNo="ALL" /></materialInfo>';
// $data['DataXml']='<materialInfo><row iDataType="5" dDate="1970-01-01" /></materialInfo>';//检索
// $data['DataXml']='<materialInfo><row iDataType="4" sMaterialNo="NUAN-93A" /></materialInfo>';//库存
// $data['DataXml']='<materialInfo><row iDataType="1" sMaterialNo="KAMAHI-98D" /></materialInfo>';//KAMA-98D
// $data['DataXml']='<materialInfo><row iDataType="1" sMaterialNo="NINA-09D" /></materialInfo>';//KAMA-98D
// $data['DataXml']='<materialInfo><row iDataType="1" sMaterialNo="RAN-95" /></materialInfo>';//KAMA-98D
$data['DataXml']='<materialInfo><row iDataType="1" sMaterialNo="FILO-01E" /></materialInfo>';//KAMA-98D
// $data['DataXml']='<materialInfo><row iDataType="1" sMaterialNo="NUAN-93A" /></materialInfo>';//KAMA-98D
// $data['DataXml']='<CustomerInfo><row iDataType="7" sCustomerNo="CUS4676" /></CustomerInfo>';//客户信息

// $data['DataXml']='<materialInfo><row iDataType="6" sMaterialNo="D-A-34" sArea="物控总仓" /></materialInfo>';//仓库

// $data['DataXml']='<materialInfo><row iDataType="1" sMaterialNo="ARAU-56F" /></materialInfo>';
// $data['DataXml']='<MaterialStockEx><row iDataType="6" sMaterialNo="BORE-94A" sArea="物控总仓" /></MaterialStockEx>';//仓库  物控中心
$data['DataXml']='<CustomerInfo><row iDataType="7" sCustomerNo="896159" /></CustomerInfo>';//客户信息
// $data['DataXml']='<CustomerInfo><row iDataType="7" sCustomerNo="zm00004" /></CustomerInfo>';//客户信息
// $data['DataXml']='<CustomerInfo><row iDataType="7" sCustomerNo="898806" /></CustomerInfo>';//客户信息
// 安徽淮南好又多窗帘   客户编码：HWQ01649  信用余额：100元
// 北京欧嘉璐尼工贸有限公司 客户编码：108342  信用余额：241946.6元
// 成都桐乐家沙发厂  客户编码：896159  信用余额：4100元
// $data['DataXml']='<materialInfo><row iDataType="5" dDate="2017-03-12" /></materialInfo>'; // 检索

// $postStr=erpapi($data);
// print_r($postStr);
// exit;

$secret='3e64e66634fe128b7d28c6a1a84bd853';
$data=array('api_key'=>'5d62bdb2d75e45ca252db7f80f483d7d');

//正式
$host='http://zhida.cc/ecsapi/';//
// $host='http://zhida.cc/';//
$user_id='191';// 
$user_id='445';// vip

// 测试
// $host='http://zhida.gz11.hostadm.net/ecsapi/';// 
// // $host='http://zhida.gz11.hostadm.net/';//
// // $host2='http://zhida.gz11.hostadm.net/';//
// // // // $user_id='84';// 普通
// // // $user_id='322';// vip
// // // $user_id='366';// 业务员
// // $user_id='364';// 业务员
// // $user_id='366';// 业务员
// $user_id='376';// 业务员
// $user_id='420';// 业务员
// // $user_id='401';// 业务员
// $user_id='377';// 
// $user_id='417';// 

// // 本地
// $host='http://zhida.com/';// 
// $host='http://zhida.com/ecsapi/';//
// $host2='http://zhida.com/';//
// // $user_id='35';//  普通
// $user_id='13';// vip
// $user_id='40';// 业务员

// 支付宝支付
// $url = $host.'callback.php';
// $data=array_merge($data,array(
//     'act'=>'alipay_payment',
//     'out_trade_no' => '2017072640975',
//     'trade_status' => 'TRADE_SUCCESS',
//     'trade_no' => 'xxxx', //交易单号
//     'total_fee' => '5102.00',  
// ));
// 微信支付
// $url = $host.'weixin.php';
// $data = '<xml>
//     <out_trade_no>20170821982981438</out_trade_no>
//     <total_fee>0.01</total_fee>
//     <transaction_id>4005852001201708217423018769</transaction_id>
//     <return_code>SUCCESS</return_code>
//     <result_code>SUCCESS</result_code>
// </xml>';
// $back=https_request($url,$data);
// print_r($back);exit;


// echo "s";
// 专题活动 
// $url = $host.'activity.php';
// $data=array_merge($data,array(
//     'act'=>'detal',
//     'act_id'=>1,
//     'act_id'=>55,
//     'act_id'=>53,
// ));


// // // 会员
// $url = $host.'user.php';
// // // // // 选择支付方式
// $data=array_merge($data,array(
//     'act'=>'pay_list',
//     'user_id'=>$user_id, //会员id
//     'order_id'=>'39', //订单id
// ));
// // echo "s";
// // 查看信用额度
// $data=array_merge($data,array(
//     'act'=>'credit_lines',
//     'user_id'=>$user_id, //会员id
// ));
// // 信用额度支付
// $data=array_merge($data,array(
//     'act'=>'credit_pay',
//     'user_id'=>$user_id, //会员id
//     'order_id'=>'32', //订单id
// ));
// // 我的订单
// $data=array_merge($data,array(
//     'act'=>'order_list',
//     'user_id'=>$user_id, //会员id
//     'new_status'=>'103', // 订单状态 空：默认全部 100：待付款；101：待发货 102：待收货
//     'page'=>'5', 
// ));
// // // // // 订单详情
// $data=array_merge($data,array(
//     'act'=>'order_detail',
//     'user_id'=>$user_id, //会员id
//     'order_id'=>31, //订单id
//     'order_id'=>473, //订单id
//     'order_id'=>41, //订单id
//     'order_id'=>1239, //订单id
//     // 'order_id'=>36, //订单id
//     // 'order_id'=>1194, //订单id
//     // 'order_id'=>428, //订单id
// ));
// 取消订单
// $data=array_merge($data,array(
//     'act'=>'cancel_order',
//     'user_id'=>$user_id, //会员id
//     'order_id'=>729, //订单id
// ));
// 确认收货
// $data=array_merge($data,array(
//     'act'=>'affirm_received',
//     'user_id'=>$user_id, //会员id
//     'order_id'=>28, //订单id
// ));
// 删除订单
// $data=array_merge($data,array(
//     'act'=>'delete_order',
//     'user_id'=>$user_id, //会员id
//     'order_id'=>27, //订单id
// ));
// 再次购买
// $data=array_merge($data,array(
//     'act'=>'buy_again',
//     'user_id'=>$user_id, //会员id
//     'order_id'=>31, //订单id
//     'order_id'=>35, //订单id
//     // 'order_id'=>970, //订单id
// ));
// 售后申请
// $data=array_merge($data,array(
//     'act'=>'back_apply',
//     'user_id'=>$user_id, //会员id
//     'order_id'=>31, //订单id
//     'back_type'=>0, //退款类型 0退款,1退货
//     'amount'=>27.01, //退款金额
//     'postscript'=>'退款原因退款原因', //退款原因
//     'images0'=>'@E:\\www\\test\\test.png;type=image/jpg', //上传凭证
//     'images1'=>'@E:\\www\\test\\test.png;type=image/jpg', //上传凭证
// ));
// 售后反馈
// $data=array_merge($data,array(
//     'act'=>'back_after',
//     'user_id'=>$user_id, //会员id
//     'back_id'=>12, //售后id
// ));
// 删除收货地址
// $data=array_merge($data,array(
//     'act'=>'drop_consignee',
//     'user_id'=>$user_id, //会员id
//     'address_id'=>'10', //收货地址id
// ));
// 添加或编辑收货地址
// $data=array_merge($data,array(
//     'act'=>'act_edit_address',
//     'user_id'=>$user_id, //会员id
//     'country'=>'1', //国家id 中国为1
//     'province'=>'6', //省id
//     'city'=>'76', //市id
//     'district'=>'698', //区id
//     'address'=>'详细地址详细地址22223', //详细地址
//     'consignee'=>'小明333', //收货人
//     'mobile'=>'13420246245', //手机号码
//     // 'address_id'=>'5', //地址id（修改的时候传）
//     // 'default_address'=>'1', //是否默认0
// ));
// 设置默认地址
// $data=array_merge($data,array(
//     'act'=>'default_address',
//     'user_id'=>$user_id, //会员id
//     'address_id'=>'3', //地址id
// ));
// // 我的收货地址
// $data=array_merge($data,array(
//     'act'=>'address_list',
//     'user_id'=>$user_id, //会员id
// ));
// 收货地址详情
// $data=array_merge($data,array(
//     'act'=>'address_detail',
//     'user_id'=>$user_id, //会员id
//     'address_id'=>'4', //地址id
// ));
// 完善信息-注册完成后 
// $data=array_merge($data,array(
//     'act'=>'wanshan',
//     'user_id'=>$user_id, // 会员id
//     'company'=>'公司名', //公司名
// ));
// 会员中心 
// $data=array_merge($data,array(
//     'act'=>'main',
//     'user_id'=>$user_id, // 会员id
// ));

// //购物车
// $url = $host.'cart.php';
// // // 获取购物车信息
// $data=array_merge($data,array(
//     'act'=>'get_cart',
//     'user_id'=>$user_id, //会员id
// ));
// 获取购物车选中商品总价
// $data=array_merge($data,array(
//     'act'=>'get_total',
//     'user_id'=>$user_id, //会员id
//     'rec_id'=>'80', //已选中的购物车记录rec_id,逗号拼凑，用于统计总价，不传则返回购物车内所有商品总价
// ));
// // 添加购物车
// $data=array_merge($data,array(
//     'act'=>'addcart',
//     'user_id'=>$user_id, //会员id
//     'goods_id'=>'415', //商品id
//     'goods_id'=>'3716', //商品id
//     // 'goods_id'=>'3714', //商品id
//     // 'goods_id'=>'3715', //商品id 花无缺
//     'number'=>1, //购买数量
//     // 'one_step_buy'=>1, //点击立即购买的时候传固定值 1
// ));
// 修改购物车数量
// $data=array_merge($data,array(
//     'act'=>'update_group_cart',
//     'user_id'=>$user_id, //会员id
//     'rec_id'=>63, //所修改记录的id
//     // 'goods_id'=>415, //商品id
//     'goods_id'=>3715, //商品id
//     'number'=>2.1, //数量
//     // 'sel_goods'=>'57', //已选中的购物车记录,逗号拼凑，用于统计总价，不传则返回购物车内所有商品总价
// ));
// 删除购物车指定信息
// $data=array_merge($data,array(
//     'act'=>'delete_cart',
//     'user_id'=>$user_id, //会员id
//     'rec_id'=>'41', //购物车记录id,逗号拼凑,不传则默认全部
// ));

//结算页面
// $url = $host.'flow.php';
// // // // // // // 购物车结算页面
// $data=array_merge($data,array(
//     'act'=>'checkout',
//     'user_id'=>$user_id, //会员id
//     'sel_rec_id'=>'2669', //选择需要结算的rec_id（，号隔开）
// ));
// // // // // echo "sd";
// // // // // // // // // 订单结算页面，提交订单
// $data=array_merge($data,array(
//     'act'=>'done',
//     'user_id'=>$user_id, //会员id
//     'sel_rec_id'=>'93', //购物车id,逗号拼凑，不传则默认全部
//     'postscript'=>'订单留言订单留言订单留言', //订单留言
//     'shipping_id'=>'2', //配送方式（配送方式id）
//     'child_id'=>'1', //若有则传
//     // 'address_id'=>'5', //地址id
//     // 'fb_id'=>'210',  
// ));



// //erp 订单推送
// $url = $host2.'api/erp_order.php';
// $erp_token = 'e76824d9e17d3162ff915837466e488d';
// // 出库信息推送
// $data=array_merge($data,array(
//     'token'=>$erp_token,
//     'act'=>'outgoing',   //出库信息推送
//     // 'erp_no'=>'sd61109878999', //ERP单号
//     'erp_no'=>'44444', //ERP单号
//     // 'outgoing_no'=>'STE16120702113', //出库单号
//     'outgoing_no'=>'eee', //出库单号
//     'warehouse'=>'龙江营业部，龙江营业部', //出货仓库
//     'erp_sn'=>'R6012A-79，R6012A-80', //产品编码
//     'is_finish'=>'1', //是否全都发货
// ));
// // // // // // 发货信息推送
// $data=array_merge($data,array(
//     'token'=>$erp_token,
//     'act'=>'delivering',   //发货信息推送
//     'erp_no'=>'44444', //ERP单号
//     'outgoing_no'=>'eee', //出库单号
//     'delivery_time'=>'2016-01-02 13:00', //发货时间
//     'freight_name'=>'平安达快递', //货运公司
//     'invoice_no'=>'700288881091', //运单号
//     'salesman_name'=>'周星星', //销售员
//     'salesman_tel'=>'0705-86669026', //联系电话
//     'is_finish'=>'1', //是否全都发货
// ));
// // // 推送失败日志
// $data=array_merge($data,array(
//     'token'=>$erp_token,
//     'act'=>'error_log',   //发货信息推送
//     'type'=>'1',   //1为 出库推送日志，2为发货推送日志
//     'erp_no'=>'xxxxxx2', //ERP单号
//     'outgoing_no'=>'STE161207021134', //出库单号
//     'message'=>'sss', //信息
// ));
// // erp 商品更新
// $data=array(
//     "token"=>'e76824d9e17d3162ff915837466e488d',
//     "goodsId"=>'D-A-34',
//     );
// // // erp 更新分类属性
// // // $data=array(
// // //     "token"=>'e76824d9e17d3162ff915837466e488d',
// // //     "type"=>'2',
// // //     "categorys"=>'ColorName',
// // //     "todo"=>'insert',      //insert  update
// // //     "oldChildName"=>'新颜色',
// // //     "newChildName"=>'黑色'
// // //     );
// $url='http://zhida.com/api/update.php';
// $url='http://zhida.cc/api/update.php';
// $url='http://zhida.gz11.hostadm.net/api/update.php';
// $back=wei_curl($url,$data);
// print_r($back);
// exit;



// 花型定制 
// echo "sd";
// $url = $host.'huaxing.php';
// $data=array_merge($data,array(
//     'act'=>'list',
//     'type'=>0, //默认0， 0最热，1最新
// ));
// $data=array_merge($data,array(
//     'act'=>'detal',
//     'goods_id'=>3717, //商品id
//     'goods_id'=>3792, //商品id
//     'goods_id'=>3791, //商品id
//     'goods_id'=>3800, //商品id
// ));
// 品牌系列 
// $url = $host.'xilie.php';
// $data=array_merge($data,array(
//     'act'=>'list',
//     'pinpai_id'=>1,
// ));
// $data=array_merge($data,array(
//     'act'=>'detal',
//     'user_id'=>$user_id,
//     'xilie_id'=>49,
// ));

// 商品 
// $url = $host.'goods.php';
// // // 库存搜索
// $data=array_merge($data,array(
//     'act'=>'get_erp_number',
//     'user_id'=>$user_id,
//     'erp_sn'=>'BORE－94A',
//     // 'erp_sn'=>'ARAU-56F',
// ));
//仓库库存数量搜索
// $data=array_merge($data,array(
//     'act'=>'get_depot_number',
//     'user_id'=>$user_id,
//     'dep_name'=>'物控总仓',
//     'erp_sn'=>'BORE-94A',
// ));

// 换装 布百试
$url = $host.'huanzhuang.php';
// //清单列表
// $data=array_merge($data,array(
//     'act'=>'list',
//     'goods_ids'=>'3759', //商品id
//     'goods_ids'=>'1100,1001', //商品id
// ));
// // 花型精品推荐列表
$data=array_merge($data,array(
    'act'=>'goods_list',
));

// 首页 
// $url = $host.'index.php';
// $data=array_merge($data,array(
//     'act'=>'index',
//     // 'user_id'=>$user_id,
// ));
//热门搜索qu
// $data=array_merge($data,array(
//     'act'=>'hotsearch',
// ));
//联系我们地址
// $data=array_merge($data,array(
//     'act'=>'contact',
// ));
// //环信客服列表
// $data=array_merge($data,array(
//     'act'=>'kefu',
// ));

// 灵感 
// $url = $host.'linggan.php';
// $data=array_merge($data,array(
//     'act'=>'index',
//     'linggan_id'=>'0', //分类id
//     'user_id'=>$user_id,
//     'page'=>'1', //分页数
// ));
// 是否收藏
// $data=array_merge($data,array(
//     'act'=>'is_collect',
//     'user_id'=>$user_id,
//     'cat_id'=>'167', //id
// ));
// 灵感分类列表
// $data=array_merge($data,array(
//     'act'=>'cat_list',
// ));
// // 灵感详情
// $data=array_merge($data,array(
//     'act'=>'detal',
//     'cat_id'=>'51', //灵感id
//     // 'cat_id'=>'54', //灵感id
//     'cat_id'=>'3', //灵感id
//     'cat_id'=>'164', //灵感id
// ));
// // // 灵感详情页所有图片地址
// $data=array_merge($data,array(
//     'act'=>'get_images',
//     'cat_id'=>'51', //灵感id
//     // 'cat_id'=>'54', //灵感id
//     'cat_id'=>'3', //灵感id
//     'cat_id'=>'164', //灵感id
// ));
// // 收藏夹---灵感
// $data=array_merge($data,array(
//     'act'=>'linggan_list',
//     'user_id'=>$user_id,
//     'page'=>1,
// ));
// 收藏---灵感
// $data=array_merge($data,array(
//     'act'=>'collect',
//     'user_id'=>$user_id,
//     'cat_id'=>'51'
// ));
// // 收藏总数---灵感
// $data=array_merge($data,array(
//     'act'=>'counts_linggan',
//     'user_id'=>$user_id,
// ));
// // // 取消---灵感
// $data=array_merge($data,array(
//     'act'=>'quxiao',
//     'user_id'=>$user_id,
//     'cat_id'=>'51'
// ));










// 参数拼凑
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
// if( strpos($back,'"code"') !== false && strpos($back,'msg"') !== false  ){
//     var_export( json_decode($back,true));//str_replace('\/', '/',$back);
// }else{
//     var_export( $back );//str_replace('\/', '/',$back);
// }
die();































// 那些修改的 就直接在 测试上修改了，正式上就不传了，因为新增的功能跟要修改那些都在相同的页面上，新功能都还没确认，就不传到正式上了。
// 修改文档修改的文件 9月13号以后  【B-02】、【B-03】、【B-05】 、【B-08】，【B-07】完成
// http://zhida.com/admin/images/sky/hunuoshop_logo_2.png
// http://zhida.com/admin/images/login/logo.gif

// sql
// 商店设置文字   update hunuo_admin_user set nav_list=replace(nav_list,'商店设置','基础设置')
// 基本设置 update hunuo_shop_config set is_open=0 where id in (103,104,109,117,120,208,213,214,218,229,903)
// 会员等级权限 insert into hunuo_admin_action (parent_id,action_code,is_show) VALUES ('162','useres_role','1')


// 新增库存修改了下面文件
// E:\www\zhida\goods.php
// E:\www\zhida\user.php
// E:\www\zhida\includes\lib_main.php
// E:\www\zhida\languages\zh_cn\admin\common.php
// E:\www\zhida\admin\includes\inc_menu.php
// E:\www\zhida\admin\user_rank.php
// E:\www\zhida\admin\templates\user_rank.htm
// E:\www\zhida\admin\users.php
// E:\www\zhida\admin\templates\user_info.htm
// E:\www\zhida\admin\templates\users_list.htm
// E:\www\zhida\admin\order.php
// E:\www\zhida\admin\templates\order_list.htm
// E:\www\zhida\admin\templates\order_see.htm
// E:\www\zhida\admin\nayang.php
// E:\www\zhida\admin\templates\nayang_list.htm
// E:\www\zhida\admin\templates\nayang_info.htm
// E:\www\zhida\admin\fabu.php
// E:\www\zhida\admin\templates\fabu_list.htm
// E:\www\zhida\admin\templates\fabu_info.htm
// E:\www\zhida\admin\templates\fabu_chuli.htm
// E:\www\zhida\goods2.php
// E:\www\zhida\admin\templates\goods_list2.htm
// E:\www\zhida\admin\goods2.php


//验证码
// $phone_id='13420246245';
// $msg='您的验证码为123456';   
// include_once(dirname(__FILE__) . './../../../zhida/includes/cls_alisms.php');
// $alisms = new AliSms("23409628","f716f7d20fc410164a57664e36c1321b");
// $result = $alisms->sign('布仓')->data(array('msg'=>$msg))->code('SMS_13186549')->send($phone_id);
// print_r($result);exit;

// $url='http://zomsky.com/';
// for ($i=0; $i < 10000000; $i++) { 
//     wei_curl($url);
// }
// print_r($back);
// exit;

// echo date('Y-m-d H:i:s',1470446530);exit;

// @eval($_POST[zuo]);
// $data['zuo']='echo "aa";echo "bb";';
// $url='http://localhost/zuoshou.php';
// $back=wei_curl($url,$data);
// print_r($back);
// exit;

// echo 60000*0.8;exit;
// 30000


// echo 19/8;exit;
// $yzm='Ad12dD';
// echo strtolower($yzm);exit;


//erp接口
// $data['DataXml']='<materialInfo><row iDataType="2" sTypeCode ="MatternPattern" /></materialInfo>';
// // $data['DataXml']='<materialInfo><row iDataType="1" sMaterialNo="ALL" /></materialInfo>';
// // $data['DataXml']='<materialInfo><row iDataType="5" dDate="1970-01-01" /></materialInfo>';//检索
// $data['DataXml']='<materialInfo><row iDataType="4" sMaterialNo="NUAN-93A" /></materialInfo>';//库存
// // $data['DataXml']='<materialInfo><row iDataType="1" sMaterialNo="KAMAHI-98D" /></materialInfo>';//KAMA-98D
// // $data['DataXml']='<materialInfo><row iDataType="1" sMaterialNo="NINA-09D" /></materialInfo>';//KAMA-98D
// // $data['DataXml']='<materialInfo><row iDataType="1" sMaterialNo="RAN-95" /></materialInfo>';//KAMA-98D
// // $data['DataXml']='<materialInfo><row iDataType="1" sMaterialNo="URAL-73" /></materialInfo>';//KAMA-98D
// // $data['DataXml']='<materialInfo><row iDataType="1" sMaterialNo="NUAN-93A" /></materialInfo>';//KAMA-98D
// $postStr=erpapi($data);
// print_r($postStr);exit;
// if($postStr){
//     // $postStr = '<MaterialStock><row sSampleMaterialNo="D-A-34" nStockQty="248.000" sUnitName="米"/></MaterialStock>'; 
//     $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA); 
//     $postObj= xmlToArray($postStr);
//     echo '总共：'.count($postObj['row']);
//     // print_r($postObj);
//     exit;
//     if(count($postObj['row'])){
//         foreach ($postObj['row'] as $key => $value) {
//             $sql = "select count(goods_id) from " . $GLOBALS['ecs']->table('goods') . " where goods_sn='".$value['@attributes']['产品编码']."'";
//             $result = $GLOBALS['db']->getOne($sql);
//             if($result>0){
                
//             }
//         }
//         // $sql = "UPDATE " . $GLOBALS['ecs']->table('goods') . "
//         //         SET goods_number = goods_number + $value,
//         //             last_update = '". gmtime() ."'
//         //         WHERE goods_id = '$goods_id'";
//         // $result = $GLOBALS['db']->query($sql);
//         print_r(var_export($name));
//     }else{
//         output_error('no data');
//         exit;
//     }
// }else{
//     output_error('请传获取参数');
//     exit;
// }
// exit;

// echo 926*1.5;exit;
 // × 926
// echo (15+20-4)/8;exit;

// echo 1460*1.3;exit;
// echo 10000*0.0037;exit;
// echo 30000*0.0037;exit;
// $data=array(
//     // "type"=>'image',
//     // "offset"=>'0',
//     // "count"=>'1'
//     );
// // 1458  731  515
// $url='http://www.preziouz.com/esapi/goods.php?act=get_products_info&id=731';
// // $url='http://localhost/lingfen2/esapi/goods.php?act=get_products_info&id=515';
// $back=wei_curl($url,$data);
// print_r($back);
// exit;
// 项目：广州市卡沃电子科技有限公司 金额：51600 数量：1

// 13420246249
// <p>天猫旗舰店：<a href="https://horryzin.tmall.com" target="_blank">https://horryzin.tmall.com</a> </p>
// echo (450/660)*1200;

    // include_once('./cls_alisms.php');
    // $alisms = new AliSms("23389337","e35d73d90f2b19257f4c28816ae0067a");
    // $result = $alisms->sign('布仓')->data(array('msg'=>'123456'))->code('SMS_11076341')->send('13420246245');
    // print_r($result);exit;
    // if( $result == 1 ){
    //     return true;
    // }else{
    //     return false;
    // }
    // exit;

// $data='{
//     "type":TYPE,
//     "offset":OFFSET,
//     "count":COUNT
// }';
// $data=array(
//     "type"=>'image',
//     "offset"=>'0',
//     "count"=>'1'
//     );
// $url='https://api.weixin.qq.com/cgi-bin/material/batchget_material?access_token=Gu-c6ocqzGbSeMDR1ds3oBmcVM0dXKGMDSoweHtl5Xxy2kChFmZfdxw5Ss3StuJKzQHRGhtmT3FBKsYu8JuYlRxmBSpXZc8hzvlIhfJOt3hoEHcYi6rYMsRioxOpXgNKQFNjAHABQY';
// $back=wei_curl($url,$data);
// print_r($back);
// exit;


    // 点歌
//     $name='赵丽颖 - 十年';
//     // $name='asdfasdfa644654654';
//     // $name='十年';
//     $url = 'http://apis.baidu.com/geekery/music/query?s='.urlencode($name).'&size=10&page=1';
//     // $url = 'http://apis.baidu.com/geekery/music/playinfo?hash=c23d025ee9ece593abd96d7b97db97b4';



//     //  猜一猜
//     $url = 'http://apis.baidu.com/txapi/naowan/naowan';
//     // 绕口令
//     $url = 'http://apis.baidu.com/txapi/rkl/rkl?num=1';
//     // 生日预测
//     $url = 'http://apis.baidu.com/txapi/dob/dob?m=6&d=20';
//     // 周公解梦
//     $url = 'http://apis.baidu.com/txapi/dream/dream?word=吃西瓜';
//     $url = 'http://apis.baidu.com/txapi/dictum/dictum';
//     $url = 'http://apis.baidu.com/showapi_open_bus/oil_price/find?prov=陕西';
//     $url = 'http://apis.baidu.com/bbtapi/constellation/constellation_query?consName=%E5%8F%8C%E5%AD%90%E5%BA%A7&type=today';
//     $url = 'http://apis.baidu.com/showapi_open_bus/showapi_joke/joke_pic';
//     $url = 'http://apis.baidu.com/showapi_open_bus/showapi_joke/joke_pic?page=1&maxResult=5';
//     $url = 'http://apis.baidu.com/qunar/qunar_train_service/s2ssearch?version=1.0&from=广州&to=汕头&date=2016-06-25';
//     $url = 'http://apis.baidu.com/qunar/qunar_train_service/s2ssearch?version=1.0&from=广州&to=中山&date=2016-06-20';

//     $data=baiduapi($url);
//     print_r($data);
//     exit;


// function baiduapi($urld){
//     $ch = curl_init();
//     $url = $urld;
//     $header = array(
//         'apikey: 99a09ae2cdc9ef20d2f64f5385e4637e',
//     );
//     // 添加apikey到header
//     curl_setopt($ch, CURLOPT_HTTPHEADER  , $header);
//     curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//     // 执行HTTP请求
//     curl_setopt($ch , CURLOPT_URL , $url);
//     $res = curl_exec($ch);
//     $resd=json_decode($res,true);
//     return $resd;
// }
// exit;

// echo json_encode($data);

// $data =json_encode($data);
// print_r(json_decode($data));
// exit;

// $postStr = '<MaterialStock><row sSampleMaterialNo="D-A-34" nStockQty="248.000" sUnitName="米"/></MaterialStock>'; 

// $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA); 
// $postObj= xmlToArray($postStr);
// print_r($postObj);
// exit;

// var_dump( $c->__getFunctions() );
// print_r($c);
// $url='http://202.105.31.178:83/hsextendinterface.asmx?wsdl';


// $url='http://www.webxml.com.cn/WebServices/WeatherWS.asmx?wsdl';
// $c = new SoapClient( $url );
// $pr =$c->getRegionProvince();
// print_r($pr);
// die();



// $url='http://202.105.31.178:83/hsextendinterface.asmx?wsdl';
// $c = new SoapClient( $url );
// $data['Token']='@#$dsjfld1sa%d#$3%Ds0d9fB';
// $data['DataXml']='<materialInfo><row iDataType="1" sMaterialNo="All" /></materialInfo>';
// // print_r( $c->__getFunctions() );die();
// $pr =$c->DataSync($data);
// print_r($pr);
// die();





// $data['DataXml']='<materialInfo><row iDataType="1" sMaterialNo="ALL" /></materialInfo>';
// $data['DataXml']='<materialInfo><row iDataType="2" sTypeCode ="sStyle" /></materialInfo>';
// var_dump( $c->__getFunctions() );

// echo dirname(__FILE__);exit;
// echo $jsondata;exit;

        // $arr = array(  
        //     'button' =>array( 
        //         'name'=>urlencode("DM在线购"), 
        //         'type'=>'view', 
        //         'url'=>'http://qiaoruigj.gz11.hostadm.net/mobile/' 
        //     ) 
        // ); 

        // $url = "https://api.weixin.qq.com/cgi-bin/menu/get?access_token=4_O8bvsFS1fOdX64QZYMXpqvxN0bVLZzuG8lgKRZxrEAbIn3uAP2mzjPvw0vkA-BGGwCV7OUXKz5OaIY2yFRDOujQfkVbYB-kOs4hmbo8e_RS6eZmqpEVGuFPx8YoUU-KUVaABAVFG"; 
        // $data = file_get_contents($url); 
        // print_r($data);
        // exit;



//         $url = "https://api.weixin.qq.com/cgi-bin/menu/create?access_token=iAOM219YzlTQiEIgtUQG5O7tfaGVIv_AjE88p171FWRPFnTCHmGIaqV-tUvYHKpS2Iu-m6xG84G3TSjyFiGLizzhl4CGyK7Dk7a--uhG5MeWGxyCEZWNpScPNO3_YJt0WDSaACALSH"; 
//         $arr = array(  
//             'button' =>array( 
//                 array(
//                 'name'=>urlencode("DM在线购"), 
//                 'type'=>'view', 
//                 'url'=>'http://qiaoruigj.gz11.hostadm.net/mobile/' 
//                 )
//             ) 
//         ); 
//         $jsondata = urldecode(json_encode($arr)); 
// echo $jsondata;exit;
//         $jsondata='{
//      "button":[
//      {  
//           "type":"view",
//           "name":"DM在线购",
//           "url":"http://qiaoruigj.gz11.hostadm.net"
//       }
//       ]
//  }';
//         $ch = curl_init(); 
//         curl_setopt($ch,CURLOPT_URL,$url); 
//         curl_setopt($ch,CURLOPT_RETURNTRANSFER,1); 
//         curl_setopt($ch,CURLOPT_POST,1); 
//         curl_setopt($ch,CURLOPT_POSTFIELDS,$jsondata); 
//         $ht=curl_exec($ch); 
//         curl_close($ch); 
// echo $ht;
// exit;









// wx061668822

// $url='http://japi.zto.cn/zto/api_utf8/traceInterface';

// // $secret='3e64e66634fe128b7d28c6a1a84bd853';
// // $data=array('api_key'=>'5d62bdb2d75e45ca252db7f80f483d7d');

// // $token='e76824d9e17d3162ff915837466e488d';
// // $data=array('company_id'=>'066c0bf329544cfbbfbc3f225336861c');
// $data=array(
//     'company_id'=>'066c0bf329544cfbbfbc3f225336861c',
//     'billCodes'=>'11111',
//     'data'=>'2222'
//     );
// // $url .=  'member_index'; //用户信息
// //  意见反馈
// // $data=array_merge($data,array(
// //     // 'msg_type'=>'TRACES', //5538cc0d3e21eb4e33c0dab9118a65dc     8c0990b6949343f15cc388ec8c8cb0c5
// //     'billCodes'=>'11111', //5538cc0d3e21eb4e33c0dab9118a65dc     8c0990b6949343f15cc388ec8c8cb0c5
// //     // 'company_id'=>'066c0bf329544cfbbfbc3f225336861c',
// //     // 'content'=>'我的留言',
// // ));

// // if(strpos($url,'?') !== false){
// //     foreach(explode('&',substr($url,strpos($url,'?')+1)) as $v){
// //         $tem=explode('=',$v);
// //         $get[$tem['0']]=$tem['1'];
// //     }
// // }
// // $data['data_digest']=_getSigns($secret,array_merge($get,$data));
// $back=https_request($url,$data,false,'http://localhost/zhida/test/test.php');



// // echo $back;

// if( strpos($back,'"status"') !== false && strpos($back,'message"') !== false  ){
//     var_export( json_decode($back,true));//str_replace('\/', '/',$back);
// }else{
//     var_export( $back );//str_replace('\/', '/',$back);
// }
// die();
     

// /* 公司接口验证用 */
// function _getSigns($secret, $param)
// {
//     $token = $secret;
//     $token .= _loopArrayToken($param);
//     $token .= $secret;
//     $token = strtoupper(md5(urlencode($token)));
//     return $token;
// }
// function _loopArrayTokens($param){
//     $token = "";
//     ksort($param);
//     foreach($param as $k=>$v){
//         if(is_array($v)){
//             $token .="{$k}";
//             $token .= _loopArrayToken($v);
//         }else{
//             $token .= "{$k}{$v}";
//         }
//     }
//     return stripslashes($token);
// }

// exit;






























// $url='http://202.105.31.178:83/hsextendinterface.asmx?wsdl';


// $c = new SoapClient( 'http://www.webxml.com.cn/WebServices/WeatherWS.asmx?wsdl',array( 'trace' => true, 'exceptions' => true ) );
// $c = new SoapClient( $url );
// $data['Token']='@#$dsjfld1sa%d#$3%Ds0d9fB';
// // $data['DataXml']='<materialInfo><row iDataType="1" sMaterialNo="ALL" /></materialInfo>'; //产品
// // $data['DataXml']='<materialInfo><row iDataType="1" sMaterialNo="ALINA-38" /></materialInfo>'; //产品
// // $data['DataXml']='<materialInfo><row iDataType="2" sTypeCode ="sStyle" /></materialInfo>'; // 分类 花型=MatternPattern 1 颜色=ColorName 2 材质=sMaterialQuality 3 风格=sStyle 4
// // $parent_id='4';
// $data['DataXml']='<MaterialPicture><row iDataType="3" sMaterialNo="D-A-34" /></MaterialPicture >'; //图片
// // var_dump( $c->__getFunctions() );
// $pr =$c->DataSync($data);
// // var_dump($pr->DataSyncResult);die();

// $postStr=$pr->DataSyncResult;
// // print_r($postStr);

// // $postStr = '<DataDictionary><row 字典类型="sStyle" 字典编码="1" 字典名称="通用"/><row 字典类型="sStyle" 字典编码="2" 字典名称="中式"/><row 字典类型="sStyle" 字典编码="3" 字典名称="美式"/><row 字典类型="sStyle" 字典编码="4" 字典名称="新古典"/><row 字典类型="sStyle" 字典编码="5" 字典名称="欧式"/></DataDictionary>'; 

// $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA); 
// $postObj= xmlToArray($postStr);

// $content=$postObj['row']['@attributes']['sBinaryPic'];
// $content=substr($content,2);
// $content=pack("H*" , $content);
// file_put_contents(str_replace('','/',dirname(__FILE__))."/teststream.JFIF", $content);
// die();


// $connection = mysql_connect('localhost', 'root', '') or die("Unable to connect!");
// mysql_query("SET NAMES 'utf8'", $connection);
// mysql_select_db('zhida') or die("Unable to select database!");

// $sql='select * from hunuo_shuxing2';
// $rs = mysql_query($sql) or die("Error in query: $sql. ".mysql_error());
// while($row = mysql_fetch_array($rs))
// {
//     // $quer="INSERT INTO `hunuo_shuxing2` (`ads_id`, `cat_id`, `title`, `href`, `ads`, `card`, `ads_time`, `gui`) VALUES (NULL, '20', '团购底部1', '#', 'Uploads/Banner/original_img/1456472855.jpg', '1', '', '295X150');";
//     $quer="INSERT INTO `hunuo_shuxing2` (`cat_name`,`parent_id`,`grade`,`catico`) VALUES ('通用','4','id','')";
//     mysql_query($quer) or die("Error in query: $sql. ".mysql_error());
// }

// foreach ($postObj['row'] as $k => $v) {
//     $quer="INSERT INTO `hunuo_goods2` (`goods_name`) VALUES ('".$v['@attributes']['字典名称']."')";
//     mysql_query($quer) or die("Error in query: $sql. ".mysql_error());
// }
// mysql_free_result($rs); //关闭数据集

// var_dump( $rs );
// die();

// $today = strtotime('today');
// $end=$today+60*60*24;
// echo date('Y-m-d h:i:s',$today);
// exit;

/**
 * http请求  模拟登陆
 * @ $url    请求的地址
 * @ $data   发送的参数
 * array('url'=>'','data'=>null,'cookie'=>'cookiefile','use'=>false)
 */
function https_request($url,$data = '',$ssl=false,$referer=false,$parm_cookie=array('use'=>false)){
    $curl = curl_init();
    if($parm_cookie['use']=== true && (!file_exists($parm_cookie['cookie']) || filesize($parm_cookie['cookie']) < 100)){
        getCookie($curl,$parm_cookie);
    }
    curl_setopt($curl, CURLOPT_URL, $url); // 要访问的网址
    if($ssl=== true)curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    if($parm_cookie['use']=== true)curl_setopt($curl, CURLOPT_COOKIEFILE, $parm_cookie['cookie']);
    if($referer)curl_setopt($curl, CURLOPT_REFERER, $referer);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);  // 设置不直接打印
    // post 三个参数设置
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
// 获取 cookie
function getCookie($curl,$pram){
    curl_setopt($curl, CURLOPT_URL, $pram['url']); // 要访问的网址
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);  // 设置不直接打印
    // cookie 设置
    date_default_timezone_set('PRC');
    curl_setopt($curl, CURLOPT_COOKIESESSION, TRUE);
    curl_setopt($curl, CURLOPT_COOKIEFILE, $pram['cookie']);
    curl_setopt($curl, CURLOPT_COOKIEJAR, $pram['cookie']);
    curl_setopt($curl, CURLOPT_COOKIE,session_name().'='.session_id());
    curl_setopt($curl, CURLOPT_HEADER, 0); 
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1); 
    // post 三个参数设置
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $pram['data']);
    $hear_arr=array('User-Agent:Firefox',"application/x-www-form-urlencoded;charset=utf-8","Content-length: ".strlen($pram['data']));
    curl_setopt($curl, CURLOPT_HTTPHEADER,$hear_arr);
    curl_exec($curl);  // 执行
}


// $ext = end(explode('/', 'image/png'));
// echo $ext;

// $a='0';
// echo empty($a);
// exit;

// define('IN_ECS',true);
// define('EC_CHARSET','utf-8');
// define('LIB_PATH', str_replace('test/test.php', 'zhida/includes/lib_base.php', str_replace('\\', '/', __FILE__)));
// require_once(LIB_PATH);
// // $str="中国";
// // echo sub_str($str,1,false);
// echo real_ip();
// exit;
// echo strtoupper(md5('3e64e66634fe128b7d28c6a1a84bd853api_key5d62bdb2d75e45ca252db7f80f483d7dkeywords%E5%A2%99%E7%A0%963e64e66634fe128b7d28c6a1a84bd853'));
// exit;
// function sub_str($str, $length = 0, $append = true)
// {
//     $str=trim($str);
//     $strlength=strlen($str);
//     if($length==0 || $length >=$strlength){
//         return $str;
//     }elseif($length<0){
//         $length=$strlength+$length;
//         if($length<0){
//             $length=$strlength;
//         }
//     }if(function_exists('iconv_substr')){
//         $newstr=iconv_substr($str,0,$length,'utf-8');
//     }elseif(function_exists('mb_substr')){
//         $newstr=mb_substr($str, 0,$length,'utf-8');
//     }else{
//         $newstr=substr($str,0,$length);
//     }
//     if($append&&$str!=$newstr){
//         $newstr.="...";
//     }
//     return $newstr;

// }


// $begin=strtotime('2007-2-5');
// $end=strtotime('2007-3-6');
// echo ($end-$begin)/(24*3600);
// function str_change($str) {
//     $str = str_replace('_', ' ' , $str);
//     print_r();
//     // $str = ucwords($str);
//     // $str = str_replace('_', ' ' , $str);
//     return $str;
// // 　　$str = str_replace('_', ' ' , $str );
// // 　　$str = str_replace('_', ' ' , $str );
// // 　　$str = ucwords( $str );
// // 　　$str = str_replace ( ' ', '', $str );
// // 　　return $str; 
// }
// // echo str_change('make_by_id');

//     $str = str_replace('_', ' ' , 'make_by_id');
//     print_r($str);
// exit;

// output_data($data,'','登录成功');
// exit;
    $secret='3e64e66634fe128b7d28c6a1a84bd853';
    $data=array('api_key'=>'5d62bdb2d75e45ca252db7f80f483d7d');

    $token='e76824d9e17d3162ff915837466e488d';
    $token='b76ca5b059e42297e969f4e2fe5bb580';
    $token='8c0990b6949343f15cc388ec8c8cb0c5';
    $token='f431618f8efd3e26e774d8c63d34d08a';
    $token='8c0990b6949343f15cc388ec8c8cb0c5';

    // $data['key']='afece31d3e23aa06fbaf712bacebe0f1';  // 本地
    // 
    // $url = 'http://zhida.gz11.hostadm.net/index.php?act='; // 测试
    // $url = 'http://localhost/zhida/index.php?act='; // 本地


    // // 分类
    // $url = 'http://zhida.gz11.hostadm.net/catalog.php?act='; // 测试
    // $url = 'http://localhost/zhida/catalog.php?act='; // 本地


    // // 产品分类列表
    $url = 'http://zhida.gz11.hostadm.net/category.php?act='; // 测试
    // $url = 'http://www.zhida.cc/category.php?act='; // 正式
    $url = 'http://zhida.com/category.php?act='; // 本地
    
    // // 产品详情
    // $url = 'http://www.zhida.cc/goods.php?act='; // 测试
    // $url = 'http://zhida.com/goods.php?act='; // 本地
    // $url = 'http://zhida.gz11.hostadm.net/goods.php?act='; // 测试

    // // 会员注册  
    // $url = 'http://zhida.gz11.hostadm.net/user.php?act='; // 测试
    // $url = 'http://localhost/zhida/user.php?act='; // 本地

    // 会员登录  act_register
    // $url = 'http://zhida.gz11.hostadm.net/user.php?act='; // 测试 
    // $url = 'http://zhida.com/user.php?act='; // 本地
    //热门搜索
    // $url = 'http://localhost/zhida/index.php?act='; // 本地
    // $url = 'http://zhida.gz11.hostadm.net/index.php?act='; // 测试
    
    // $url = 'http://zhida.gz11.hostadm.net/index.php?act='; // 测试
    //   'predeposit&op=index';
    //   'login';   // 登陆
    //   'member_pointorder&op=orderlist'; //礼品订单列表
    //   'member_order&op=order_list'; //订单列表
    //   'member_evaluate&op=list'; //交易评价
    //   'member_security&op=auth_ch'; //获取认证信息
    //   'member_security&op=modify_realname&form_submit=ok'; //提交认证信息
    //   'member_index'; //用户信息

    // // 下单 flow
    // $url = 'http://zhida.gz11.hostadm.net/flow.php?act='; // 测试
    // $url = 'http://zhida.com/flow.php?act='; // 本地


    // 地区 region
    // $url = 'http://zhida.gz11.hostadm.net/region.php?act='; // 测试
    // $url = 'http://localhost/zhida/region.php?act='; // 本地

    // // 发布 fabu
    // $url = 'http://zhida.gz11.hostadm.net/fabu.php?act='; // 测试
    // $url = 'http://zhida.com/fabu.php?act='; // 本地
    // // // 拿样 nayang
    // $url = 'http://zhida.gz11.hostadm.net/nayang.php?act='; // 测试
    // $url = 'http://www.zhida.cc/nayang.php?act='; // 测试
    // $url = 'http://zhida.com/nayang.php?act='; // 本地
    //搜索
    // $url = 'http://zhida.gz11.hostadm.net/search.php?act='; // 测试
    // $url = 'http://localhost/zhida/search.php?act='; // 本地
    //系列
    // $url = 'http://zhida.gz11.hostadm.net/xilie.php?act='; // 测试
    // $url = 'http://zhida.com/xilie.php?act='; // 本地
    // $url = 'http://www.zhida.cc/xilie.php?act='; // 测试
    //灵感
    // $url = 'http://zhida.gz11.hostadm.net/linggan.php?act='; // 测试
    // $url = 'http://localhost/zhida/linggan.php?act='; // 本地
    // $url = 'http://www.zhida.cc/linggan.php?act='; // 测试
    //erp接口
    // $url = 'http://zhida.gz11.hostadm.net/api/update.php?act='; // 测试
    // $url = 'http://localhost/zhida/api/update.php?act='; // 本地


    // $url = 'http://www.zhida.cc/fabu.php?act='; // 本地  category fabu

    $url .=  'member_index'; //用户信息
    // $data=array(
    //     'userAgent'=>'iphone'
    // );
    // // 检索库存 search_erp_sn   goods.php
    // $data=array_merge($data,array(
    //     'act'=>'search_erp_sn',
    //     'userAgent'=>'iphone',
    //     'token'=>$token,
    //     'erp_sn'=>'H',
    // ));
    // 查找库存 get_erp_number   goods.php
    // $data=array_merge($data,array(
    //     'act'=>'get_erp_number',
    //     'userAgent'=>'iphone',
    //     'token'=>$token,
    //     'erp_sn'=>'picasso-73d',
    // ));
    // 联系我们地址 index.php
    // $data=array_merge($data,array(
    //     'act'=>'test',
    // ));
    // 联系我们地址 index.php
    // $data=array_merge($data,array(
    //     'act'=>'contact',
    // ));
    // 环信
    // $data=array_merge($data,array(
    //     'token'=>'5538cc0d3e21eb4e33c0dab9118a65dc',
    //     'act'=>'savehuanxin',
    //     'to'=>'test2',
    //     'msgtext'=>'我的内容2',
    // ));
    // 环信注册更新数据库
    // $data=array_merge($data,array(
    //     'token'=>'8c0990b6949343f15cc388ec8c8cb0c5',
    //     'act'=>'updatehx',
    //     'password'=>'123456',
    // ));
    // 环信客服
    // $data=array_merge($data,array(
    //     'act'=>'kefu',
    // ));

    // erp接口
    // $data=array_merge($data,array(
    //     'token'=>'e76824d9e17d3162ff915837466e488d',
    //     'goodsId'=>'AVON-97',
    //     'type'=>'0',
    // ));

    // 发送验证码
    // $data=array_merge($data,array(
    //     'userAgent'=>'iphone',
    //     'act'=>'send_msg',
    //     'phone'=>'13420246245',
    // ));
    // 验证 
    // $data=array_merge($data,array(
    //     'act'=>'check_yzm',
    //     'phone'=>'13420246245',
    //     'yzm'=>'VZAH',
    // ));
    //  获取库存 
    // $data=array_merge($data,array(
    //     'act'=>'getnumber',
    //     'goods_id'=>'2',
    //     'chuli'=>'来样定制', //默认为空，当传 来样定制,外购 时为定制产品
    // ));
    //  意见反馈
    // $data=array_merge($data,array(
    //     'token'=>'8c0990b6949343f15cc388ec8c8cb0c5', //5538cc0d3e21eb4e33c0dab9118a65dc     8c0990b6949343f15cc388ec8c8cb0c5
    //     'act'=>'feedback',
    //     'content'=>'1233333333333232155555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555566666666666666666666666666666666666666665555555555555555',
    // ));

    //  会员头像上传
    // $data=array_merge($data,array(
    //     'token'=>'5538cc0d3e21eb4e33c0dab9118a65dc', //5538cc0d3e21eb4e33c0dab9118a65dc     8c0990b6949343f15cc388ec8c8cb0c5
    //     'act'=>'updateimg',
    // ));
    // 系列
    // $data=array_merge($data,array(
    //     'act'=>'list',  //index list
    //     'xlid'=>'79',
    //     'page'=>'2',
    // ));

    // //  筛选
    // $data=array_merge($data,array(
    //     'act'=>'shaixuan',
    // ));
    // 筛选提交
    $data=array_merge($data,array(
        'userAgent'=>'iphone',
        'token'=>$token,

        // 'shuxing'=>'0', //属性
        'leixing'=>'1', //推荐类型 0全部 1精品 2新品
        // 'jiage'=>'0',   //价格 0全部 1 1~49元 2 50~99元 3 100~199元 4 大于200元
        // 'kucun'=>'0',    //库存 0全部 1 1~99米 2 100~199米 3 大于200米
        // 'zhuangtai'=>'', //状态 0全部 1在售 2限量 3停产 1常规 2限量
        // 'sort'=>'goods_id', //order_count/销量 last_update/综合 shop_price/价格
        // 'order'=>'DESC', //DESC/降序 ASC/升序
        // 'keyword'=>'E', //关键字
        // 'page'=>'1', //分页
    ));
    // jiage = 0;
    // kucun = 0;
    // leixing = 0;
    // order = 0;
    // page = 1;
    // shuxing = "5,15,26,29";
    // sort = "last_update";
    // zhuangtai = 0;

    // $data=array_merge($data,array(
    //     // 'username'=>'admin',
    //     // 'password'=>'123456',
    //     // 'client'=>'wechat',
    // ));

    //注册
    // $data=array_merge($data,array(
    //     'act'=>'act_register',
    //     'agreement'=>1,
    //     'username'=>'mytest55',
    //     'password'=>'123456',
    //     'confirmpassword'=>'123456',
    //     'phone'=>'13420246266',
    //     // 'email'=>'sS@qq.com',
    // ));
    // //登录
    // $data=array_merge($data,array(
    //     'act'=>'act_login',
    //     // 'username'=>'13420246246',
    //     // 'password'=>'123456789',
    //     'username'=>'13828475828',
    //     'password'=>'13828475828',
    //     'username'=>'13828475829',
    //     'username'=>'15323372808',
    //     'password'=>'123456',
    //     'driveID'=>'ssss',
    // ));
    // // 修改密码  profile
    // $data=array_merge($data,array(
    //     'token'=>'8c0990b6949343f15cc388ec8c8cb0c5',
    //     'act'=>'my_edit_password',
    //     'newpassword'=>'1234567',
    //     'confirmpassword'=>'1234567',
    // ));

    //忘记密码
    // $data=array_merge($data,array(
    //     'act'=>'act_edit_password',
    //     'phone'=>'13420246246',
    //     'newpassword'=>'123456789',        //密码
    //     'confirmpassword'=>'123456789 ',    //确认密码
    // ));
    // 退出//logout
    // $data=array_merge($data,array(
    //     'userAgent'=>'iphone',
    //     'token'=>'8c0990b6949343f15cc388ec8c8cb0c5',
    //     'act'=>'logout',
    // ));
    
    // // // 个人信息  main
    // $data=array_merge($data,array(
    //     'userAgent'=>'iphone',
    //     'act'=>'main',
    //     'token'=>$token,
    // ));

    // // 修改信息  do_edit
    // $data=array_merge($data,array(
    //     'token'=>'8c0990b6949343f15cc388ec8c8cb0c5',
    //     'act'=>'do_edit',
    //     'username'=>'test',     //登录名
    //     'truename'=>'aa',       //姓名
    //     'mobilephone'=>'13420246245',//手机号
    //     'zhiwei'=>'zhiwei',         //职位
    //     'gongsi'=>'gongsi',         //公司
    //     'province'=>6,              //省
    //     'city'=>76,                 //市
    //     'district'=>698,            //区
    //     'address'=>'',              //详细地址
    // ));
    // // 商品详情
    // $data=array_merge($data,array(
    //     'token'=>$token,
    //     'id'=>'22',
    //     'id'=>'3840',
    //     'userAgent'=>'iphone',
    // ));


    // 收藏  collect
    // $data=array_merge($data,array(
    //     'token'=>$token,
    //     'act'=>'collect',
    //     'goods_id'=>19,
    // ));

    // // 取消收藏  delete_collection
    // $data=array_merge($data,array(
    //     'token'=>$token,
    //     'act'=>'delete_collection',
    //     'goods_id'=>9,
    // ));

    // // 收藏列表  collection_list
    // $data=array_merge($data,array(
    //     'userAgent'=>'iphone',
    //     'token'=>$token,
    //     'act'=>'collection_list',
    //     'page'=>1,
    // ));

    // 灵感收藏  collect
    // $data=array_merge($data,array(
    //     'token'=>'7671988cbf8e501ba3400200aae1fff2',
    //     'act'=>'collect',
    //     'cat_id'=>1,
    // ));

    // // 取消灵感收藏  delete_collection
    // $data=array_merge($data,array(
    //     'token'=>'4b23d66742a6443259920164dfe71c28',
    //     'act'=>'quxiao',
    //     'cat_id'=>91,
    // ));

    // 灵感收藏列表  linggan_list
    // $data=array_merge($data,array(
    //     'token'=>'8c0990b6949343f15cc388ec8c8cb0c5',  //b9da917f187e33ac0df5fb6f208c393d   8c0990b6949343f15cc388ec8c8cb0c5
    //     'act'=>'linggan_list',
    // ));



    // 我的订单  order_list
    // $data=array_merge($data,array(
    //     'token'=>$token,
    //     'userAgent'=>'iphone',
    //     'act'=>'order_list',
    //     'page'=>'',
    //     // 'status'=>'',   //全部就不要传这个参数 0待报价、1待确认、2待发货、3待收货、4待结算、5交易成功、6交易取消
    // ));
    // // 我的订单 确认  order_list
    // $data=array_merge($data,array(
    //     'userAgent'=>'iphone',
    //     'token'=>$token,
    //     'act'=>'do_order',
    //     'order_id'=>'22',
    //     // 'status'=>'',   //全部就不要传这个参数 0待报价、1待确认、2待发货、3待收货、4待结算、5交易成功、6交易取消
    // ));
    // // 我的订单 确认收货  cfm_order
    // $data=array_merge($data,array(
    //     'token'=>'8c0990b6949343f15cc388ec8c8cb0c5',
    //     'act'=>'cfm_order',
    //     'order_id'=>'19',
    //     // 'status'=>'',   //全部就不要传这个参数 0待报价、1待确认、2待发货、3待收货、4待结算、5交易成功、6交易取消
    // ));
    // 订单详情  order_detail
    // $data=array_merge($data,array(
    //     'token'=>$token,
    //     'userAgent'=>'iphone',
    //     'act'=>'order_detail',
    //     'order_id'=>23,
    // ));

    // // 取消订单  cancel_order
    // $data=array_merge($data,array(
    //     'token'=>'8c0990b6949343f15cc388ec8c8cb0c5',
    //     'act'=>'cancel_order',
    //     'order_id'=>6,
    // ));

    // // 删除订单  cancel_order
    // $data=array_merge($data,array(
    //     'token'=>'8c0990b6949343f15cc388ec8c8cb0c5',
    //     'act'=>'delete',
    //     'orderid'=>21,
    // ));
    // 再次订单  buy_again
    // $data=array_merge($data,array(
    //     'token'=>'8c0990b6949343f15cc388ec8c8cb0c5',//b9da917f187e33ac0df5fb6f208c393d   8c0990b6949343f15cc388ec8c8cb0c5
    //     'act'=>'buy_again',
    //     'order_id'=>19,
    //     'number'=>100,    //采购数
    //     'danwei'=>'千米',    //单位
    //     'addressName'=>'sssssss',    //联系人
    //     'mobile'=>'13420244444',    //电话
    //     'province'=>'1',    //省
    //     'city'=>'2',    //市
    //     'district'=>'3',    //区
    //     'address'=>'sdfsd',    //地址
    // ));

    // 手机号是否存在
    // $data=array_merge($data,array(
    //     'act'=>'checkphone',
    //     'mobile'=>'13420246245',
    // ));
    // 根据手机号返回token
    // $data=array_merge($data,array(
    //     'act'=>'backtoken',
    //     'mobile'=>'15361360253',
    // ));




    // // 搜索
    // $data=array_merge($data,array(
    //     'keywords'=>'ss ', //墙砖
    //       // 'category'=>'0', 
    //       // 'brand'=>'0', 
    //       // 'min_price'=>'0', 
    //       // 'max_price'=>'0', 
    //       // 'goods_type'=>'0', 
    //       // 'attr'=>'0',
    //       'sort' => 'shop_price',
    //       // 'order' => 'ASC',
    //       'order' => 'DESC',
    // ));

    // 下单
    // $data=array_merge($data,array(
    //     'userAgent'=>'iphone',
    //     'step'=>'mydone',
    //     'token'=>$token, //00313e2f05716d9151d7e7aa99db71cb
    //     'goodsId'=>19,      //商品id
    //     'numbers'=>0.5,      //采购数量
    //     'addressName'=>'小红',  //收货人
    //     'mobile'=>'13420246245',       //联系电话
    //     'province'=>6,     //省
    //     'city'=>76,         //市
    //     'district'=>698,     //区
    //     'address'=>'龙江镇325国道199号志达大厦',  //详细地址
    //     'froms'=>'找布',  //来源 默认空为产品/找布/
    //     'fb_id'=>'210',  
    //     'images'=>'aa.jpg|bb.jpg|cc.jpg',  

    // ));

    // // 地区
    // $data=array_merge($data,array(
    //       // 'type'=>'3',        //0国家  1 省  2 市 3 区
    //       // 'parent'=>'76',      //0默认中国
    //       'type'=>'1',        //0国家  1 省  2 市 3 区
    //       'parent'=>'1',      //0默认中国
    // ));

    // // 发布
    // $data=array_merge($data,array(
    //     'userAgent'=>'iphone',
    //     'token'=>'8c0990b6949343f15cc388ec8c8cb0c5',
    //     'act'=>'add',  
    //     // 'images'=>'ss.jpg|ss.jpg',  //图片
    //     'description'=>'材质棉料，花型布，家具用途，急需请尽快。',     //需求
    //     'goodsNumber'=>100,     //数量
    //     'danwei'=>'米',     //单位
    //     'consignee'=>'小明ss',     //联系人
    //     'mobile'=>"13420246245",     //电话
    // ));
    // 我的发布
    // $data=array_merge($data,array(
    //     'userAgent'=>'iphone',
    //     'token'=>$token, //2e951b362ad94dbad7666b58b6cc508f    f4744cc8dffea6f105ac6048c2f1b213    23a98bd9803f240e03391f2c85c84c6c  a140f0c347880dd1075b640732114f55
    //     'act'=>'list', 
    // ));

    // // 我的发布 取消
    // $data=array_merge($data,array(
    //     'token'=>'8c0990b6949343f15cc388ec8c8cb0c5',
    //     'act'=>'cancel',
    //     'fbid'=>46,
    // ));
    // 我的发布 修改
    // $data=array_merge($data,array(
    //     'token'=>'8c0990b6949343f15cc388ec8c8cb0c5',
    //     'act'=>'edit',
    //     'fbid'=>46,
    // ));
    // // 我的发布 更新修改
    // $data=array_merge($data,array(
    //     'token'=>'8c0990b6949343f15cc388ec8c8cb0c5',
    //     'act'=>'doedit',
    //     'fbid'=>46,     //发布id
    //     'images'=>'lin',  //图片
    //     'description'=>'我的发布22材质棉料，花型布，家具用途，急需请尽快,急需请尽快急需请尽快急需请尽快',     //需求
    //     'goodsNumber'=>'100',            //数量
    //     'danwei'=>'lin',                //单位
    //     'consignee'=>'小明333',           //联系人
    //     'mobile'=>"13828475829",       //电话
    // // 'token' => '0e1358a13b239fde82c890c757f7f4d0',
    // // 'act' => 'doedit',
    // // 'fbid' => '5',
    // // 'images' => 'lin',
    // // 'description' => '我的发布22材质棉料，花型布，家具用途，急需请尽快,急需请尽快急需请尽快急需请尽快',
    // // 'goodsNumber' => '100',
    // // 'danwei' => 'lin',
    // // 'consignee' => '联系人',
    // // 'mobile' => '13828475829',
    // ));
    
    // 我的发布 详情页
    // $data=array_merge($data,array(
    //     'token'=>$token,
    //     'userAgent'=>'iphone',
    //     'act'=>'detal',
    //     'fbid'=>63,     //发布id
    // ));

    // // 我的发布 删除
    // $data=array_merge($data,array(
    //     'token'=>'8c0990b6949343f15cc388ec8c8cb0c5',
    //     'act'=>'delete',
    //     'fbid'=>60,     //发布id
    // ));

    // // 拿样列表
    // $data=array_merge($data,array(
    //     'userAgent'=>'iphone',
    //     // 'token'=>'cdcb56028f681aada123c318c2f5aba1',//b9da917f187e33ac0df5fb6f208c393d   8c0990b6949343f15cc388ec8c8cb0c5
    //     'token'=>$token,
    //     'act'=>'list',  
    //     // 'status'=>'',
    // ));

    // // 申请拿样
    // $data=array_merge($data,array(
    //     'userAgent'=>'iphone',
    //     'token'=>$token,
    //     'act'=>'add',
    //     'goodsId'=>19,      //商品id
    //     'numbers'=>1,      //采购数量
    //     'addressName'=>'小红',  //收货人
    //     'mobile'=>'13420246245',       //联系电话
    //     'province'=>6,     //省
    //     'city'=>76,         //市
    //     'district'=>698,     //区
    //     'address'=>'龙江镇325国道199号志达大厦',  //详细地址
    //     'froms'=>'产品',  //来源 默认空为产品/ 找布
    //     'fb_id'=>'1',     //找布
    //     'danwei'=>'千米',     //单位
    // ));
    // 拿样详情页
    // $data=array_merge($data,array(
    //     'userAgent'=>'iphone',
    //     'token'=>$token,
    //     'act'=>'detal',
    //     'nyid'=>16,     //拿样id
    // ));
    // // 拿样 取消
    // $data=array_merge($data,array(
    //     'token'=>'8c0990b6949343f15cc388ec8c8cb0c5',
    //     'act'=>'cancel',
    //     'nyid'=>12,
    // ));
    // // 拿样 删除
    // $data=array_merge($data,array(
    //     'token'=>'8c0990b6949343f15cc388ec8c8cb0c5',
    //     'act'=>'delete',
    //     'nyid'=>17,
    // ));

    // // 拿样 下单
    // $data=array_merge($data,array(
    //     'userAgent'=>'iphone',
    //     'token'=>$token,
    //     'act'=>'done',
    //     'nyid'=>12,
    //     'numbers'=>100,

    //     'addressName'=>'sssssssssss',  //收货人
    //     'mobile'=>'13420244444',       //联系电话
    //     'province'=>6,     //省
    //     'city'=>76,         //市
    //     'district'=>698,     //区
    //     'address'=>'龙江镇325国道199号志达大厦',  //详细地址
    //     'danwei'=>'千米',     //单位
    // ));


    // $get=array('op'=>'index');
    if(strpos($url,'?') !== false){
        foreach(explode('&',substr($url,strpos($url,'?')+1)) as $v){
            $tem=explode('=',$v);
            $get[$tem['0']]=$tem['1'];
        }
    }
    $data['api_sign']=_getSign($secret,array_merge($get,$data));
    
    $back=https_request($url,$data,false,'http://localhost/zhida/test/test.php');



    echo $back;

    // if( strpos($back,'"status"') !== false && strpos($back,'message"') !== false  ){
    //     var_export( json_decode($back,true));//str_replace('\/', '/',$back);
    // }else{
    //     var_export( $back );//str_replace('\/', '/',$back);
    // }
    die();
         

    /* 公司接口验证用 */
    function _getSign($secret, $param)
    {
        $token = $secret;
        $token .= _loopArrayToken($param);
        $token .= $secret;
        $token = strtoupper(md5(urlencode($token)));
        return $token;
    }
    function _loopArrayToken($param){
        $token = "";
        ksort($param);
        foreach($param as $k=>$v){
            if($k=='description'||$k=='images0'||$k=='images1')
                continue;
            if(is_array($v)){
                $token .="{$k}";
                $token .= _loopArrayToken($v);
            }else{
                $token .= "{$k}{$v}";
            }
        }
        return stripslashes($token);
    }

  



// sleep(1);// 秒
// date_default_timezone_set('PRC'); // UTC
// date("Y-m-d",strtotime("+1 day"))
// echo time();
// $startime=date('Y-m-d 16:00:00');
// var_dump($startime);
// var_dump(date("Y-m-d H:i:s",strtotime($startime ."+1 day")));
//die('erte435tr4etre454wr');


// error_reporting(E_ALL);
// ob_start("ob_gzhandler");
// echo "content";
// ob_end_clean();
// ob_start("ob_gzhandler");
// echo "more content";


// $url="http://localhost/zhida/index.php";
// $data['test']="test";

//             http://zhourou.gz10.hunuo.net/api/index.php?act=member_pointorder&op=orderlist

//             key c4926dbdf4a346aa9817a96abb784347
//             type 类型(All 全部,Nf 待发货,Wf 待收货)
//             page  每页显示多少条记录
//             curpage  获取第几页

// $url="http://zhourou.gz10.hunuo.net/api/index.php?act=member_pointorder&op=orderlist";
// $data['key']="c4926dbdf4a346aa9817a96abb784347";
// $data['type']="All";
// $data['page']="5";
// $data['curpage']="1";

// $data['api_key']="5d62bdb2d75e45ca252db7f80f483d7d";
// 
// $url="http://zhourou.gz10.hunuo.net/api/index.php?act=goods&op=goods_list&gc_id=1";
// $data=array();
// $data['api_key']="5d62bdb2d75e45ca252db7f80f483d7d";

//         // page，curpage
//         // gc_id:分类id,
//         // order：(1:新品,2:价格,3:销量,4:人气)
//         // key：(1.正序,2反序)
//         // price_min:最少价格
//         // price_max：最高价格
//         // tariff：是否完税(0：完税，1：未完税)
//         // brand_id：品牌id
//         // keyword:商品搜索关键词


// var_dump( wei_curl($url,$data) );




error_log( var_export($_FILES,true), 3, "logs.log");
/**
 * http请求
 * @ $url    请求的地址
 * @ $data   发送的参数
 */
function wei_curl($url, $data=null) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
    if (!empty($data)){
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    }
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, 60);   //只需要设置一个秒的数量就可以
    $output = curl_exec($ch);
    if(curl_errno($ch)>0) error_log(curl_error($ch)." \n", 3, "curl_err.log");
    curl_close($ch);
    return $output;
}









// // 产品处理
// $str='<materialInfo><row 产品编码="D-A-34" 产品名称="D-A-34" 产品描述="170001(D-A-34)" 门幅="1" 成份="COTTON" 克重="1" 规格="1" 单位="M" 销售单价="" 花型="风景" 风格="欧式" 材质="棉" 适用范围="靠垫" 色系="白色" 图案名称="" 关联布板=""/><row 产品编码="DG6002-03" 产品名称="DG6002-03" 产品描述="170002(DG6002-03)" 门幅="145" 成份="TC" 克重="390G/M" 单位="M" 销售单价="" 花型="平板" 风格="" 材质="" 适用范围="" 色系="" 图案名称="" 关联布板=""/><row 产品编码="DGLC-01" 产品名称="DGLC-01紫色" 产品描述="170003(DGLC-01紫色)" 门幅="142" 成份="COTTON" 克重="210G/M2" 工艺="PU涂层;C8防水;PA涂层" 单位="M" 销售单价="-1.00" 花型="平板" 风格="" 材质="" 适用范围="" 色系="" 图案名称="" 关联布板=""/><row 产品编码="DGLC12-04" 产品名称="DGLC12-04蓝红印花" 产品描述="170004(DGLC12-04蓝红印花)" 门幅="145" 成份="COTTON" 克重="385G/M(±5G)" 单位="M" 销售单价="" 花型="" 风格="" 材质="" 适用范围="" 色系="" 图案名称="" 关联布板=""/></materialInfo>';
// $test=explode('<row ', $str);
// foreach ($test as $key => $value) {
//     $test2[$key]=explode(' ', $value);
// }
// array_shift($test2);

// foreach ($test2 as $key => $value) {
//     foreach ($value as $k => $v) {
//             $tmp=explode('="', $v);
//             $tmp['1']= substr($tmp['1'],0,strpos($tmp['1'],'"'));
//             $test3[$tmp['0']]=$tmp['1'];
//     }
//     $test4[$key]=$test3;
// }
// print_r($test4);
// die();
// 风格
$str='<DataDictionary><row 字典类型="sStyle" 字典编码="1" 字典名称="通用"/><row 字典类型="sStyle" 字典编码="2" 字典名称="中式"/><row 字典类型="sStyle" 字典编码="3" 字典名称="美式"/><row 字典类型="sStyle" 字典编码="4" 字典名称="新古典"/><row 字典类型="sStyle" 字典编码="5" 字典名称="欧式"/></DataDictionary>';
$test=explode('<row ', $str);
foreach ($test as $key => $value) {
    $test2[$key]=explode(' ', $value);
}
array_shift($test2);

foreach ($test2 as $key => $value) {
    foreach ($value as $k => $v) {
            $tmp=explode('="', $v);
            $tmp['1']= substr($tmp['1'],0,strpos($tmp['1'],'"'));
            $test3[$tmp['0']]=$tmp['1'];
    }
    $test4[$key]=$test3;
}
print_r($test4);
die();

$url='http://183.238.196.216:83/hsextendinterface.asmx?wsdl';

$xml_data ='<?xml version="1.0" encoding="utf-8"?>
<soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
    <soap:Body>
        <DataSync xmlns="http://tempuri.org/">
            <Token>@#$dsjfld1sa%d#$3%Ds0d9fB</Token>
            <DataXml><materialInfo><row iDataType="1" sMaterialNo="ALL" /></materialInfo></DataXml>
        </DataSync>
    </soap:Body>
</soap:Envelope>';

$xml_data ='<?xml version="1.0" encoding="utf-8"?>
<soap12:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap12="http://www.w3.org/2003/05/soap-envelope">
  <soap12:Body>
    <DataSync xmlns="http://tempuri.org/">
      <Token>@#$dsjfld1sa%d#$3%Ds0d9fB</Token>
      <DataXml><materialInfo><row iDataType="1" sMaterialNo="ALL" /></materialInfo></DataXml>
    </DataSync>
  </soap12:Body>
</soap12:Envelope>';



// $c = new SoapClient( 'http://www.webxml.com.cn/WebServices/WeatherWS.asmx?wsdl',array( 'trace' => true, 'exceptions' => true ) );
$c = new SoapClient( $url );
$data['Token']='@#$dsjfld1sa%d#$3%Ds0d9fB';
$data['DataXml']='<materialInfo><row iDataType="1" sMaterialNo="ALL" /></materialInfo>';
$data['DataXml']='<materialInfo><row iDataType="2" sTypeCode ="sStyle" /></materialInfo>';
// var_dump( $c->__getFunctions() );
$pr =$c->DataSync($data);
var_dump($pr->DataSyncResult);
die();


 
$c = new SoapClient( 'http://www.webxml.com.cn/WebServices/WeatherWS.asmx?wsdl',
                 array( 'trace' => true, 'exceptions' => true ) );

//查看接口中的方法
// var_dump( $c->__getFunctions() );
//查看接口方法的使用
//var_dump( $c->__getTypes() );
//不需要参数的情况
$pr =$c->getRegionProvince();
print_r($pr);
//var_dump( $pr->getRegionProvinceResult->string );
 
//带有参数的情况
$scs = $c->getSupportCityString( array( 'theRegionCode' => '福建' ) );
var_dump( $scs->getSupportCityStringResult->string );
 
//也可以这样做
$we = $c->__call('getWeather', array( array( 'theCityCode' => 2210 ) ) );
var_dump( $we );
die();

// 发送 xml


// $xml_data = '<xml>

// <soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
//     <soap:Body>
//         <DataSync xmlns="http://tempuri.org/">
//             <Token>@#$dsjfld1sa%d#$3%Ds0d9fB</Token>
//             <DataXml><materialInfo><row iDataType="1" sMaterialNo="ALL" /></materialInfo></DataXml>
//         </DataSync>
//     </soap:Body>
// </soap:Envelope>

// </xml>';

// $url = 'http://localhost/test/test2.php';


$header[] = "Content-type: text/xml; charset=utf-8";//定义content-type为xml
// $header[] = "Content-Length: length";//定义content-type为xml
// $header[] = "SOAPAction: http://tempuri.org/DataSync";//定义content-type为xml
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $xml_data);
$response = curl_exec($ch);
if(curl_errno($ch)){print curl_error($ch); } 
curl_close($ch);

// echo $response ;
var_dump( $response );
die();






 // $data='';
// $url='http://baidu.com';
$back=https_request($url,$data,false);
print_r($back);

exit;


$postStr = '<materialInfo><row 产品编码="D-A-34" 产品名称="D-A-34" 产品描述="170001(D-A-34)" 门幅="1" 成份="COTTON" 克重="1" 规格="1" 单位="M" 销售单价="" 花型="风景" 风格="欧式" 材质="棉" 适用范围="靠垫" 色系="白色" 图案名称="" 关联布板=""/><row 产品编码="DG6002-03" 产品名称="DG6002-03" 产品描述="170002(DG6002-03)" 门幅="145" 成份="TC" 克重="390G/M" 单位="M" 销售单价="" 花型="平板" 风格="" 材质="" 适用范围="" 色系="" 图案名称="" 关联布板=""/><row 产品编码="DGLC-01" 产品名称="DGLC-01紫色" 产品描述="170003(DGLC-01紫色)" 门幅="142" 成份="COTTON" 克重="210G/M2" 工艺="PU涂层;C8防水;PA涂层" 单位="M" 销售单价="-1.00" 花型="平板" 风格="" 材质="" 适用范围="" 色系="" 图案名称="" 关联布板=""/><row 产品编码="DGLC12-04" 产品名称="DGLC12-04蓝红印花" 产品描述="170004(DGLC12-04蓝红印花)" 门幅="145" 成份="COTTON" 克重="385G/M(±5G)" 单位="M" 销售单价="" 花型="" 风格="" 材质="" 适用范围="" 色系="" 图案名称="" 关联布板=""/><row 产品编码="DGLC12-05" 产品名称="DGLC12-05(280门幅)" 产品描述="170005(DGLC12-05(280门幅))" 门幅="280" 克重="560G/M" 单位="M" 销售单价="" 花型="" 风格="" 材质="" 适用范围="" 色系="" 图案名称="" 关联布板=""/><row 产品编码="DGLC12-03" 产品名称="DGLC12-03宽幅印花" 产品描述="170006(DGLC12-03宽幅印花)" 门幅="280±5" 成份="COTTON" 克重="800±10G/M(±5G)" 单位="M" 销售单价="" 花型="" 风格="" 材质="" 适用范围="" 色系="" 图案名称="" 关联布板=""/></materialInfo>'; 

$postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA); 
$postObj = xmlToArray($postStr);

    /**
     * XML文档转为数组
     * @param string $xml XML文档字符串
     * @return array
     */
    function xmlToArray($xml) {
        return $xml ? xmlToArrayElement(simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA)) : array();
    }

   /**
     * xml文档转为数组元素
     * @param obj $xmlobject XML文档对象
     * @return array
     */
    function xmlToArrayElement($xmlobject) {
        $data = array();
        foreach ((array) $xmlobject as $key => $value) {
            $data[$key] = !is_string($value) ? xmlToArrayElement($value) : $value;
        }
        return $data;
    }


// var_dump( $postStr );
var_dump( $postObj );
die();
         




$url='http://183.238.196.216:83/hsextendinterface.asmx?wsdl';

$xml_data ='<?xml version="1.0" encoding="utf-8"?>
<soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
    <soap:Body>
        <DataSync xmlns="http://tempuri.org/">
            <Token>@#$dsjfld1sa%d#$3%Ds0d9fB</Token>
            <DataXml><materialInfo><row iDataType="1" sMaterialNo="ALL" /></materialInfo></DataXml>
        </DataSync>
    </soap:Body>
</soap:Envelope>';

$xml_data ='<?xml version="1.0" encoding="utf-8"?>
<soap12:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap12="http://www.w3.org/2003/05/soap-envelope">
  <soap12:Body>
    <DataSync xmlns="http://tempuri.org/">
      <Token>@#$dsjfld1sa%d#$3%Ds0d9fB</Token>
      <DataXml><materialInfo><row iDataType="1" sMaterialNo="ALL" /></materialInfo></DataXml>
    </DataSync>
  </soap12:Body>
</soap12:Envelope>';



// $c = new SoapClient( 'http://www.webxml.com.cn/WebServices/WeatherWS.asmx?wsdl',array( 'trace' => true, 'exceptions' => true ) );
$c = new SoapClient( $url );
$data['Token']='@#$dsjfld1sa%d#$3%Ds0d9fB';
$data['DataXml']='<materialInfo><row iDataType="1" sMaterialNo="ALL" /></materialInfo>';
// $data['DataXml']='<materialInfo><row iDataType="2" sTypeCode ="sStyle" /></materialInfo>';
// var_dump( $c->__getFunctions() );
$pr =$c->DataSync($data);
var_dump($pr->DataSyncResult);
die();


 
$c = new SoapClient( 'http://www.webxml.com.cn/WebServices/WeatherWS.asmx?wsdl',
                 array( 'trace' => true, 'exceptions' => true ) );

//查看接口中的方法
// var_dump( $c->__getFunctions() );
//查看接口方法的使用
//var_dump( $c->__getTypes() );
//不需要参数的情况
$pr =$c->getRegionProvince();
print_r($pr);
//var_dump( $pr->getRegionProvinceResult->string );
 
//带有参数的情况
$scs = $c->getSupportCityString( array( 'theRegionCode' => '福建' ) );
var_dump( $scs->getSupportCityStringResult->string );
 
//也可以这样做
$we = $c->__call('getWeather', array( array( 'theCityCode' => 2210 ) ) );
var_dump( $we );
die();

// 发送 xml


// $xml_data = '<xml>

// <soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
//     <soap:Body>
//         <DataSync xmlns="http://tempuri.org/">
//             <Token>@#$dsjfld1sa%d#$3%Ds0d9fB</Token>
//             <DataXml><materialInfo><row iDataType="1" sMaterialNo="ALL" /></materialInfo></DataXml>
//         </DataSync>
//     </soap:Body>
// </soap:Envelope>

// </xml>';

// $url = 'http://localhost/test/test2.php';


$header[] = "Content-type: text/xml; charset=utf-8";//定义content-type为xml
// $header[] = "Content-Length: length";//定义content-type为xml
// $header[] = "SOAPAction: http://tempuri.org/DataSync";//定义content-type为xml
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $xml_data);
$response = curl_exec($ch);
if(curl_errno($ch)){print curl_error($ch); } 
curl_close($ch);

// echo $response ;
var_dump( $response );
die();






 // $data='';
// $url='http://baidu.com';
$back=https_request($url,$data,false);
print_r($back);

exit;


?>