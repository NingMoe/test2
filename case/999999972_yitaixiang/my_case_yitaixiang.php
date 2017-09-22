<?php 
header('Content-Type:text/html;charset=utf-8');
// ini_set("max_execution_time", "18000");
// ini_set("memory_limit", "1000M");
date_default_timezone_set('PRC'); //设置中国时区 
ini_set( 'display_errors', 1 ); // Off
error_reporting(E_ALL);

    $secret='db4e2e01549ebef835a9f1b89b5b11cf';
    $data=array('api_key'=>'600300253268ea8b8d687fe1a79a2603');

    // $url='http://yitaixiang.gz7.hostadm.net/';// 测试
    $url='http://eastshow.cn/';// 测试
    $url='http://www.eastshow.cn/';// 测试
    // $url='http://yitaixiang.com/';// 本地
    
    // $token='e76824d9e17d3162ff915837466e488d';
    // $user_id='66';// 测试
    // $user_id='308';// 测试
    // $user_id='312';// 测试 总代
    $user_id='66';// 本地

    // $user_id='84';// 测试
    // $user_id='67';// 本地 总代 13420246244
    // $user_id='63';// 测试 总代 18067859786

    // 会员order_list address_list  act_edit_address  drop_consignee  act_address_default my_message  my_message_details my_message_del send_message register act_login get_user_info act_edit_profile act_edit_password reset_passwd logout collection_list collection collection_del act_edit_img card_list bind_bank_card edit_bank_card card_detail del_bank_card done order_detail cancel_order affirm_received apply_agent add_goods goods_list change_price pai_list add_pai proxy_list goods_info del_goods_img share_list share
    // $url .='ecsapi/user.php?act='; 
    // 商品分类、列表   getcat get_goods
    // $url .='ecsapi/category.php?act='; 
    // 商品详情 goodsedit
    // $url .='ecsapi/goods.php?act='; 
    // 地区列表
    // $url .='ecsapi/region.php?act='; 
    // 首页 index checkdaili search_keywords
    $url .='ecsapi/index.php?act='; 
    // 文章 get_article get_article_list kefu
    // $url .='ecsapi/article.php?act='; 

    $url .=  'member_index'; //用户信息

    // 热门搜索 
    // $data=array_merge($data,array(
    //     'act'=>'search_keywords',
    // ));
    // 分享列表 
    // $data=array_merge($data,array(
    //     'act'=>'share_list',
    //     'user_id'=>$user_id, //会员id 
    //     'page'=>1,
    // ));
    // 分享 
    // $data=array_merge($data,array(
    //     'act'=>'share',
    //     'user_id'=>$user_id, //会员id 
    //     'content'=>'内容内容',// 内容备注
    // ));
    // 新闻中心列表 
    // $data=array_merge($data,array(
    //     'act'=>'get_article_list',
    //     'page'=>1,
    // ));
    // 获取文章 
    // $data=array_merge($data,array(
    //     'act'=>'get_article',
    //     'article_id'=>6, //文章id   帮助中心id:155  售后服务id:157  关于我们id:158  协议id:6  
    // ));
    // 客服中心 
    // $data=array_merge($data,array(
    //     'act'=>'kefu',
    // ));
    // 客服中心留言
    // $data=array_merge($data,array(
    //     'act'=>'message',
    //     'user_id'=>$user_id,
    //     'content'=>'user_iduser_id',
    // ));
    // 拍摄管理列表
    // $data=array_merge($data,array(
    //     'act'=>'pai_list',
    //     'user_id'=>$user_id, //会员id 
    //     'page'=>1, //页数 
    // ));
    // 新增/编辑 拍摄商品 todo
    // $data=array_merge($data,array(
    //     'act'=>'add_pai',
    //     'user_id'=>$user_id, //会员id 
    //     // 'goods_id'=>143, //商品id 编辑时传该参数
    //     // 'goods_id'=>63, //商品id 编辑时传该参数
    //     // 'goods_id'=>8275, //商品id 编辑时传该参数
    //     'goods_brief'=>'goods_briefgoods_brief2',
    //     // 'user_sn'=>'1146', //对应供货商编号 编辑时不用传
    //     // 'user_sn'=>'1023', //对应供货商编号 编辑时不用传
    //     // 'user_sn'=>'1002', //对应供货商编号 编辑时不用传
    //     'goods_name'=>'king2s22',// 商品名称 编辑时不用传
    //     'shop_price'=>11, //供货价 
    //     // 'video'=>'@E:\\www\\test\\video_691476930504.mp4;type=image/mp4',
    //     // 'video'=>'@E:\\www\\test\\1479196082713.mp4;type=mp4',
    //     'images0'=>'@E:\\www\\test\\1.jpg;type=image/jpeg',
    //     'images1'=>'@E:\\www\\test\\test.jpg;type=image/jpeg',
    // ));
    // 商品设置价格
    // $data=array_merge($data,array(
    //     'act'=>'change_price',
    //     'user_id'=>$user_id, //会员id 
    //     'goods_id'=>46, //商品id 
    //     'shop_price'=>11, //供货价 
    // ));
    // 商品管理列表
    // $data=array_merge($data,array(
    //     'act'=>'goods_list',
    //     'user_id'=>$user_id, //会员id 
    //     'page'=>1, //页数 
    // ));
    // 商品管理信息
    // $data=array_merge($data,array(
    //     'act'=>'goods_info',
    //     'user_id'=>$user_id, //会员id 
    //     'goods_id'=>46, //goods_id
    // ));
    // 删除商品图片
    // $data=array_merge($data,array(
    //     'act'=>'del_goods_img',
    //     'user_id'=>$user_id, //会员id 
    //     'img_id'=>611, //图片id
    // ));
    // 发布商品 todo
    // $data=array_merge($data,array(
    //     'act'=>'add_goods',
    //     'user_id'=>$user_id, //会员id 
    //     // 'goods_id'=>52, //商品id 
    //     'goods_name'=>'king44sss',
    //     'goods_brief'=>'goods_briefgoods_brief2',
    //     'shop_price'=>'111',
    //     'goods_desc'=>'goods_descgoods_desc3',
    //     'color'=>'颜色',
    //     'zhongshui'=>'种水',
    //     'kuanshi'=>'款式',
    //     'ticai'=>'题材',
    //     // 'video'=>'@E:\\www\\test\\aa.png;type=image/jpeg',
    //     'images0'=>'@E:\\www\\test\\1.jpg;type=image/jpeg',
    //     // 'images1'=>'@E:\\www\\test\\aa.png;type=image/jpeg',
    // ));
    // 申请代理 todo
    // $data=array_merge($data,array(
    //     'act'=>'apply_agent',
    //     'user_id'=>$user_id, //会员id 
    //     'username'=>'king',
    //     'mobile_phone'=>'13420246245',  //手机号码
    //     'real_name'=>'成铭', //姓名
    //     'card'=>'440512456789789', //身份证
    //     'face_card'=>'@E:\\www\\test\\logo.png;type=image/jpeg', //身份证正面
    //     'back_card'=>'@E:\\www\\test\\aa.png;type=image/jpeg', //身份证反面
    //     'code'=>'18566465663', //邀请码 //总代理
    // ));
    // 我的代理
    // $data=array_merge($data,array(
    //     'act'=>'proxy_list',
    //     'user_id'=>$user_id, //会员id 
    //     'page'=>'1', //页数
    // ));
    // 收藏商品列表
    // $data=array_merge($data,array(
    //     'act'=>'collection_list',
    //     'user_id'=>$user_id, //会员id
    //     'page'=>1, //页数
    // ));
    // 添加收藏商品
    // $data=array_merge($data,array(
    //     'act'=>'collection',
    //     'user_id'=>$user_id, //会员id
    //     'goods_id'=>28, //商品id
    // ));
    // // 删除收藏商品
    // $data=array_merge($data,array(
    //     'act'=>'collection_del',
    //     'user_id'=>$user_id, //会员id
    //     'goods_id'=>28, //商品id
    // ));
    // 下订单
    // $data=array_merge($data,array(
    //     'act'=>'done',
    //     'user_id'=>$user_id, //会员id
    //     'goods_sn'=>'ECS000028',      //商品编码货号
    //     'numbers'=>1,      //数量
    //     'addressName'=>'小红',  //收货人
    //     'mobile'=>'13420246245',       //联系电话
    //     'province'=>6,     //省
    //     'city'=>76,         //市
    //     'district'=>698,     //区
    //     'address'=>'龙江镇325国道199号志达大厦',  //详细地址
    // ));
    // 我的订单列表
    // $data=array_merge($data,array(
    //     'act'=>'order_list',
    //     'user_id'=>$user_id, //会员id
    //     // 'composite_status'=>105, // 订单状态 101：待发货；105：已发货；102：已完成
    // ));
    // 订单详情
    // $data=array_merge($data,array(
    //     'act'=>'order_detail',
    //     'user_id'=>$user_id, //会员id
    //     'order_id'=>56, //订单id
    //     'order_id'=>13, //订单id
    // ));
    // 取消订单
    // $data=array_merge($data,array(
    //     'act'=>'cancel_order',
    //     'user_id'=>$user_id, //会员id
    //     'order_id'=>17, //订单id
    // ));
    // 确认收货
    // $data=array_merge($data,array(
    //     'act'=>'affirm_received',
    //     'user_id'=>$user_id, //会员id
    //     'order_id'=>23, //订单id
    // ));

    // 删除银行卡
    // $data=array_merge($data,array(
    //     'act'=>'del_bank_card',
    //     'user_id'=>$user_id, //会员id
    //     'bankcard_id'=>'3',//银行卡id
    // ));
    // 绑定银行卡
    // $data=array_merge($data,array(
    //     'act'=>'bind_bank_card',
    //     'user_id'=>$user_id, //会员id
    //     'real_name'=>'ss', //姓名
    //     'card_no'=>'123456789123456789', //银行卡号
    //     'bank_type'=>'1', //银行卡类型
    //     'status'=>'1', //是否默认
    // ));
    // 编辑银行卡
    // $data=array_merge($data,array(
    //     'act'=>'edit_bank_card',
    //     'bankcard_id'=>'9',//银行卡id
    //     'user_id'=>$user_id, //会员id
    //     'real_name'=>'ssss', //姓名
    //     'card_no'=>'1234567891234567890', //银行卡号
    //     'bank_type'=>'2', //银行卡类型
    //     'status'=>'0', //是否默认
    // ));
    // $data=array_merge($data,array(
    //     'act'=>'bank_list',
    // ));
    // 银行卡列表
    // $data=array_merge($data,array(
    //     'act'=>'card_list',
    //     'user_id'=>$user_id, //会员id
    //     'page'=>1, //页数
    // ));
    // 银行卡详情
    // $data=array_merge($data,array(
    //     'act'=>'card_detail',
    //     'user_id'=>$user_id, //会员id
    //     'bankcard_id'=>'2', //银行卡id
    // ));
    // 删除我的消息
    // $data=array_merge($data,array(
    //     'act'=>'my_message_del',
    //     'user_id'=>$user_id, //会员id
    //     'msg_id'=>'3', //消息id
    // ));
    // 我的消息详情
    // $data=array_merge($data,array(
    //     'act'=>'my_message_details',
    //     'user_id'=>$user_id, //会员id
    //     'msg_id'=>'3', //消息id
    // ));
    // 我的消息
    // $data=array_merge($data,array(
    //     'act'=>'my_message',
    //     'user_id'=>$user_id, //会员id
    //     'page'=>'1', //分页页码
    // ));
    // 设置默认收货地址
    // $data=array_merge($data,array(
    //     'act'=>'act_address_default',
    //     'user_id'=>$user_id, //会员id
    //     'id'=>'86', //收货地址id
    // ));
    // 删除收货地址
    // $data=array_merge($data,array(
    //     'act'=>'drop_consignee',
    //     'user_id'=>$user_id, //会员id
    //     'id'=>'78', //收货地址id
    // ));
    // 添加或编辑收货地址
    // $data=array_merge($data,array(
    //     'act'=>'act_edit_address',
    //     'user_id'=>$user_id, //会员id
    //     // 'address_id'=>'78', //收货地址id（修改的时候传）
    //     'country'=>'1', //国家id 中国为1
    //     'province'=>'6', //省id
    //     'city'=>'76', //市id
    //     'district'=>'698', //区id
    //     'address'=>'详细地址详细地址2222', //详细地址
    //     'consignee'=>'小明2', //收货人
    //     'mobile'=>'13420246245', //手机号码
    // ));
    // 我的收货地址
    // $data=array_merge($data,array(
    //     'act'=>'address_list',
    //     'user_id'=>$user_id, //会员id
    // ));
    // 地区列表 ecsapi/region.php?
    // $data=array_merge($data,array(
    //     'type'=>3, //类型 0：国家（查省）1：省（查市）2市（查区）
    //     'parent'=>76, //地区id  国家只要中国，id为1，获取省就用type=1&parent=1
    // ));
    // 修改会员头像 user.php
    // $data=array_merge($data,array(
    //     'act'=>'act_edit_img',
    //     'user_id'=>$user_id, //会员id
    //     'headimg'=>'@E:\\www\\test\\logo.png;type=image/jpeg', //会员头像图片
    //     // 'headimg'=>'@'.dirname(__FILE__).'\logo.png;type=image/jpeg', //会员头像图片
    // ));
    // 首页
    $data=array_merge($data,array(
        'act'=>'index',
        'user_id'=>$user_id, //会员id 
    ));
    // 代理商认证查询
    // $data=array_merge($data,array(
    //     'act'=>'checkdaili',
    //     // 'user_name'=>'123456', //会员名或手机号 本地
    //     // 'user_name'=>'13622255555', // 测试
    //     // 'user_name'=>'13699999999', // 测试
    //     // 'user_name'=>'13420246245', // 测试
    //     'user_name'=>'15820264658', // 测试
    // ));
    // 获取商品分类
    // $data=array_merge($data,array(
    //     'act'=>'getcat',
    // ));
    // 获取商品列表
    // $data=array_merge($data,array(
    //     'act'=>'get_goods',
    //     // 'user_id'=>$user_id, //会员id（有就传）
    //     'cat_id'=>'-1', // 商品分类
    //     // 'cat_id'=>'1', // 商品分类
    //     'sort'=>'last_update', // last_update（最新） shop_price
    //     'order'=>'', // ASC（顺序排列），DESC（倒叙排列）

    //     'sort_o'=>'shop_price', // shop_price（价格）
    //     'order_o'=>'DESC', // ASC（顺序排列），DESC（倒叙排列）

    //     // 'keywords'=>'测试 ', // 搜索是传的值
    //     // 'page'=>'2', // 页数
    //     'show_nav'=>1, // 是否显示头部两个分类
    //     // 'intro'=>'promotion', // 新品new 热销hot 特价promotion

    //     // 'tuijian'=>'best', // 推荐口:best
    //     // 'xiangqian'=>'qian', // 镶嵌口:qian

    // ));
    // 获取商品详情
    // $data=array_merge($data,array(
    //     'act'=>'goodsedit',
    //     // 'user_id'=>$user_id,
    //     'goods_id'=>'58', // 商品id
    //     // 'goods_id'=>'234', // 正式商品id
    // ));
    // //获取验证码
    // $data=array_merge($data,array(
    //     'act'=>'send_message',
    //     'phone'=>'13420246245', //手机号码
    //     'send_type'=>'2',  //发送类型（1：注册验证码，2忘记密码验证码）
    // ));
    //注册
    // $data=array_merge($data,array(
    //     'act'=>'register',
    //     'mobile_phone'=>'13420246244', //手机号码
    //     'mobile_code'=>'123456',//验证码（暂时可不填）
    //     'password'=>'123456',
    //     'confirm_password'=>'123456',
    //     'agreement'=>1,
    // ));
    // //登录
    // $data=array_merge($data,array(
    //     'act'=>'act_login',
    //     // 'user_name'=>'13420246245',
    //     // 'password'=>'123456',
    //     // 'user_name'=>'18067859786',
    //     // 'password'=>'123456',
    //     // 'user_name'=>'13902493720',
    //     // 'password'=>'123456',
    //     'user_name'=>'13800138000',
    //     'password'=>'123456',
    // ));
    // // 获取会员信息
    // $data=array_merge($data,array(
    //     'act'=>'get_user_info',
    //     'user_id'=>$user_id, //会员id 
    // ));
    // // 修改会员信息
    // $data=array_merge($data,array(
    //     'act'=>'act_edit_profile',
    //     'user_id'=>$user_id, //会员id 
    //     'username'=>'1234567890ss',  //用户名
    //     'user_weixin'=>'sss',  //微信名
    //     // 'mobile_phone'=>'13902493720',  //手机号码
    //     // 'real_name'=>'成铭2', //姓名
    //     // 'country'=>'1', //国家id 中国为1
    //     // 'province'=>'6', //省id
    //     // 'city'=>'76', //市id
    //     // 'district'=>'698', //区id
    //     // 'address'=>'详细地址详细地址2222', //详细地址
    //     // 'card'=>'440512456789789', //身份证
    //     // 'face_card'=>'@E:\\www\\test\\logo.png;type=image/jpeg', //身份证正面
    //     // 'back_card'=>'@E:\\www\\test\\aa.png;type=image/jpeg', //身份证反面
    // ));
    // // 修改密码
    // $data=array_merge($data,array(
    //     'act'=>'act_edit_password',
    //     'old_password'=>'123456',  //原密码
    //     'new_password'=>'123456', //新密码
    //     'confirm_password'=>'123456', //确认密码
    //     'user_id'=>$user_id, //会员id 
    // ));
    // //忘记密码
    // $data=array_merge($data,array(
    //     'act'=>'reset_passwd',
    //     'mobile_phone'=>'13420246245', //手机号码
    //     'mobile_code'=>'349911', //验证码
    //     'new_password'=>'123456',        //新密码
    //     'confirm_password'=>'123456',    //确认密码
    // ));
    // 退出//logout
    // $data=array_merge($data,array(
    //     'act'=>'logout',
    // ));


    // $get=array('op'=>'index');
    if(strpos($url,'?') !== false){
        foreach(explode('&',substr($url,strpos($url,'?')+1)) as $v){
            $tem=explode('=',$v);
            $get[$tem['0']]=$tem['1'];
        }
    }
    $data['api_sign']=_getSign($secret,array_merge($get,$data));
    $back=https_request($url,$data,false,'http://yitaixiang.com/');
print_r($back);exit;
    // echo $back;

    if( strpos($back,'"code"') !== false && strpos($back,'msg"') !== false  ){
        var_export( json_decode($back,true));//str_replace('\/', '/',$back);
    }else{
        var_export( $back );//str_replace('\/', '/',$back);
    }
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
            if ($k=='headimg'||$k=='face_card'||$k=='back_card'||$k=='video'||$k=='images0'||$k=='images1') continue;
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
?>