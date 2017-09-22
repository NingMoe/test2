<?php 
header('Content-Type:text/html;charset=utf-8');
// ini_set("max_execution_time", "18000");
// ini_set("memory_limit", "1000M");
date_default_timezone_set('PRC'); //设置中国时区 
ini_set( 'display_errors', 1 ); // Off
error_reporting(E_ALL);

// 13608888199 Ygh427209
// 13533074100 123456

// user_type         会员类型(1普通会员/2代购会员/3代理会员/4代购代理会员)
    $secret='ba8a48b0e34226a2992d871c65600a7c';
    $data=array('api_key'=>'472cef95417718e7890985a74ca1dabf');
    $url='http://luna.com/';// 本地
    // $token='e76824d9e17d3162ff915837466e488d';
    $user_id='84';// 本地  // 代购代理 13790903138
    // $user_id='93';// 本地  // 代理  15989293873
    // $url='http://luna.gz7.hostadm.net/';// 测试
    // $url='http://www.bits.so/';// 测试
    // $url='http://www.bitsblue.cn/';// 测试
    // $url='http://luna.com/';// 测试
    // // // $user_id='130';// 测试 代理代购 13432642477
    // // // $user_id='326';// 测试 代理代购 13608888199   Ygh427209
    // $user_id='152';// 测试 18604710016    密码 nalifu1970
// 15848919111  密码 000131

    // $user_id='320';// 测试 代购 13420246244
    // $user_id='190';// 测试 代理代购
    // $user_id='151';// 测试 代理 13420246245
    // $user_id='129';// 测试 
    // $user_id='132';// 测试 
    // $user_id='143';// 测试 
    // $user_id='353';// 测试 
    // $user_id='247';// 测试 
    // $user_id='456';// 测试 
    // $user_id='487';// 测试 
    // $user_id='143';// 测试 
    // $user_id='152';// 测试 
    // $user_id='170';// 测试 
    // $user_id='503';// 测试 
    // $user_id='153';// 测试 
    // 我的活动 activity
    // $url .='ecsapi/activity.php?act='; 
    // 支付 payment_parameter
    // $url .='ecsapi/payment.php?act='; 
    // $url .='ecsapi/callback.php?act='; 
    // 会员 address_list  act_edit_address  drop_consignee  act_address_default my_message  my_message_details my_message_del order_list order_detail cancel_order affirm_received back_order back_order_act back_list back_order_detail get_user_info my_agent set_scale_goods set_scale my_scale get_code common_goods_list common_goods_add common_goods_sale common_goods_price common_goods_del purchasing_apply agent_apply
    // $url .='ecsapi/user.php?act='; 
    // search_keywords
    // $url .='ecsapi/index.php?act='; 
    // 商品分类、列表
    // $url .='ecsapi/category.php?act='; 
    // 商品详情 goodsedit
    // $url .='ecsapi/goods.php?act='; 
    // 地区列表
    // $url .='ecsapi/region.php?act='; 
    // 购物车 addcart get_cart delete_cart update_group_cart clear
    // $url .='ecsapi/cart.php?act='; 
    // 结算页面 done select_shipping select_payment change_bonus checkout
    // $url .='ecsapi/flow.php?act='; 
    // $url .='ecsapi/flow2.php?act='; 
    // 我的收益 loan index
    // $url .='ecsapi/income.php?act='; 
    $url .='ecsapi/index.php?act='; 
    // get_art_details
    // $url .='ecsapi/article.php?act='; 
    $url .=  'member_index'; //用户信息
    // 文章
    // $data=array_merge($data,array(
    //     'act'=>'get_art_details',
    //     'article_id'=>4, //文章id
    // ));
    // 首页
    $data=array_merge($data,array(
        'act'=>'get_index',
        // 'user_id'=>$user_id, //会员id
    ));
    // $data=array_merge($data,array(
    //     'act'=>'test',
    //     'keywords'=>'测试', //会员id
    // ));
    // 我的收益
    // $data=array_merge($data,array(
    //     'act'=>'index',
    //     'user_id'=>$user_id, //会员id
    // ));
    // $data=array_merge($data,array(
    //     'act'=>'test',
    //     'user_id'=>$user_id, //会员id
    // ));
    // 文件上传
    // $data=array_merge($data,array(
    //     'act'=>'upload',
    //     'file'=>'@'.dirname(__FILE__).'\Cluna.txt', //会员头像图片
    //     // 'file'=>'@E:\\www\\test\\test.png;type=image/jpeg', //长期居住证明
    // ));
    // // // 我的货款
    // $data=array_merge($data,array(
    //     'act'=>'loan',
    //     'user_id'=>$user_id, //会员id
    //     // 'page'=>2, //会员id
    // ));
    // // 我的佣金
    // $data=array_merge($data,array(
    //     'act'=>'brokerage',
    //     'user_id'=>$user_id, //会员id
    //     'page'=>1, //会员id
    // ));
    // // 我的佣金
    // $data=array_merge($data,array(
    //     'act'=>'test',
    //     'user_id'=>$user_id, //会员id
    //     'page'=>1, //会员id
    // ));
    // 申请提现
    // $data=array_merge($data,array(
    //     'act'=>'act_account',
    //     'user_id'=>$user_id, //会员id
    //     'amount'=>'2', //提现金额
    //     'bankcard_id'=>'', //银行卡id
    // ));
    // 提现记录
    // $data=array_merge($data,array(
    //     'act'=>'account_log',
    //     'user_id'=>$user_id, //会员id
    //     'page'=>'1', // 页数
    // ));
    // 银行类型
    // $data=array_merge($data,array(
    //     'act'=>'bank_list',
    // ));
    // 添加银行卡
    // $data=array_merge($data,array(
    //     'act'=>'bind_bank_card',
    //     'user_id'=>$user_id, //会员id
    //     'real_name'=>'ss', //姓名
    //     'card_no'=>'123456789123456789', //银行卡号
    //     'bank_type'=>'1', //银行卡类型
    //     'status'=>'1', //是否默认
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
    //     'bankcard_id'=>'40', //银行卡id
    // ));
    // 编辑银行卡
    // $data=array_merge($data,array(
    //     'act'=>'edit_bank_card',
    //     'user_id'=>$user_id, //会员id
    //     'bankcard_id'=>'3',//银行卡id
    //     'real_name'=>'ssss', //姓名
    //     'card_no'=>'1234567891234567890', //银行卡号
    //     'bank_type'=>'1', //银行卡类型
    //     'status'=>'1', //是否默认
    // ));
    // 删除银行卡
    // $data=array_merge($data,array(
    //     'act'=>'del_bank_card',
    //     'user_id'=>$user_id, //会员id
    //     'bankcard_id'=>'22',//银行卡id
    // ));
    // 订单结算页面，提交订单
    // $data=array_merge($data,array(
    //     'step'=>'done',
    //     'user_id'=>$user_id, //会员id
    //     'best_time'=>'假日均可', //固定值（工作日/周末/假日均可）
    //     // 'bonus'=>'20427', //商品使用的优惠劵（用,隔开）
    //     // 'how_oos'=>'0', //固定0
    //     'postscript'=>'', //订单留言
    //     'payment'=>'1', //payment（支付方式id）
    //     // 'sel_cartgoods'=>'1293', //购物车id
    //     // 'pay_ship'=>'3', //配送方式("1:2,3:4")
    //     // 'images0'=>'@E:\\www\\test\\logo.png;type=image/jpeg', //身份证正面
    //     // 'images1'=>'@E:\\www\\test\\aa.png;type=image/jpeg', //身份证反面
    //     // 'upload_file'=>'@E:\\www\\test\\aa.png;type=image/jpeg', //多图片上，最新
    //     // 'have_consignee'=>'1', // todo
    // ));
    // 订单结算页面，改变收货方式
    // $data=array_merge($data,array(
    //     'step'=>'select_shipping',
    //     'user_id'=>$user_id, //会员id
    //     'recid'=>'', //配送方式id
    //     'suppid'=>'', //店铺id
    // ));
    // 订单结算页面，改变支付方式
    // $data=array_merge($data,array(
    //     'step'=>'select_payment',
    //     'user_id'=>$user_id, //会员id
    //     // 'payment'=>$payment, //付款方式列表里的payment
    // ));
    // 订单结算页面，改变支付方式
    // $data=array_merge($data,array(
    //     'act'=>'payment_list',
    // ));
    // 填写订单页，选择优惠劵接口
    // $data=array_merge($data,array(
    //     'step'=>'change_bonus',
    //     'user_id'=>$user_id, //会员id
    //     'bonus'=>0, //优惠劵id
    // ));
    // 购物车结算页面
    // $data=array_merge($data,array(
    //     'step'=>'checkout',
    //     'user_id'=>$user_id, //会员id
    //     'sel_cartgoods'=>'8451', //选择需要结算的rec_id（，号隔开）
    // ));
    // 修改购物车数量
    // $data=array_merge($data,array(
    //     'act'=>'update_group_cart',
    //     'user_id'=>$user_id, //会员id
    //     'rec_id'=>1170, //所修改记录的id
    //     'number'=>2, //数量
    //     'goods_id'=>210, //商品id
    //     'is_package'=>0, //会员id  todo
    //     'suppid'=>0, //会员id  todo
    // ));
    // 清空购物车
    // $data=array_merge($data,array(
    //     'act'=>'clear',
    //     'user_id'=>$user_id, //会员id
    // ));
    // 删除购物车指定信息
    // $data=array_merge($data,array(
    //     'act'=>'delete_cart',
    //     'id'=>'1171,sdsf', //购物车记录id
    // ));
    // 获取购物车信息
    // $data=array_merge($data,array(
    //     'act'=>'get_cart',
    //     'user_id'=>$user_id, //会员id
    // ));
    // // 添加购物车
    // $data=array_merge($data,array(
    //     'act'=>'addcart',
    //     'user_id'=>$user_id, //会员id
    //     'goods_id'=>'313', //商品id
    //     'goods_id'=>'210', //商品id
    //     'number'=>1, //购买数量
    //     // 'parent'=>'', //点击立即购买的时候传 固定值 0 ；
    //     // 'one_step_buy'=>'1', //点击立即购买的时候传 固定值 1 ；
    //     // 'spec'=>'1', //商品属性
    //     // 'quick'=>'', //有属性传1，没有属性传0
    // ));
    // 确认收货
    // $data=array_merge($data,array(
    //     'act'=>'affirm_received',
    //     'user_id'=>$user_id, //会员id
    //     'order_id'=>133, //订单id
    // ));
    // 取消订单
    // $data=array_merge($data,array(
    //     'act'=>'cancel_order',
    //     'user_id'=>$user_id, //会员id
    //     'order_id'=>79, //订单id
    // ));
    // // 我的订单
    // $data=array_merge($data,array(
    //     'act'=>'order_list',
    //     'user_id'=>$user_id, //会员id
    //     // 'composite_status'=>'104', // 订单状态 100：待付款；101：待收货；103：待评论；104：已完成
    //     'page'=>'1', 
    // ));
    // // $data=array_merge($data,array(
    // //     'act'=>'test2',
    // //     'user_id'=>$user_id, //会员id
    // //     // 'composite_status'=>'104', // 订单状态 100：待付款；101：待收货；103：待评论；104：已完成
    // //     'page'=>'1', 
    // // ));
    // // // // 订单详情
    // $data=array_merge($data,array(
    //     'act'=>'order_detail',
    //     'user_id'=>$user_id, //会员id
    //     'order_id'=>265, //订单id
    //     'order_id'=>1450, //订单id
    //     'order_id'=>1473, //订单id
    //     'order_id'=>1116, //订单id
    //     // 'order_id'=>983, //订单id
    //     // 'order_id'=>133, //订单id
    //     // 'order_id'=>128, //订单id
    // ));
    // 支付响应接口
    // $data=array_merge($data,array(
    //     'act'=>'wxpay_payment',
    //     'user_id'=>$user_id, //会员id
    //     'pay_id'=>'7',       // 支付方式id
    //     'order_id'=>109,       // 订单号
    // ));
    // 支付请求信息
    // $data=array_merge($data,array(
    //     'act'=>'payment_parameter',
    //     'user_id'=>$user_id, //会员id
    //     'pay_id'=>'1',       // 支付方式id
    //     'order_id'=>109,       // 订单号
    //     'order_id'=>2192,       // 订单号
    //     'order_id'=>2191,       // 订单号
    //     // 'order_id'=>134,       // 订单号
    // ));
    // 我的活动-列表
    // $data=array_merge($data,array(
    //     'act'=>'activity_list',
    //     'user_id'=>$user_id, //会员id
    //     'type'=>0,       // 0 全部 1有效活动 2过往活动 3草稿箱
    //     'page'=>0,       // 页数
    // ));
    // 我的活动-删除
    // $data=array_merge($data,array(
    //     'act'=>'delete',
    //     'user_id'=>$user_id, //会员id
    //     'act_id'=>1243,       // 活动id
    // ));
    // 我的活动-详情
    // $data=array_merge($data,array(
    //     'act'=>'activity_detail',
    //     'user_id'=>$user_id, //会员id
    //     'act_id'=>132,       // 0 活动id
    // ));
    // 我的活动-分享详情页
    // $data=array_merge($data,array(
    //     'act'=>'activity_share_detail',
    //     'user_id'=>$user_id, //会员id
    //     'act_id'=>11,       // 0 活动id
    // ));
    // 我的活动-计算利润(填单价计算服务费跟利润)
    // $data=array_merge($data,array(
    //     'act'=>'profit',
    //     'user_id'=>$user_id, //会员idactivity
    //     'goods_id'=>210,       // 商品id
    //     // 'goods_id'=>393,       // 商品id
    //     'price'=>300,       // 商品价格
    // ));
    // 我的活动-停用
    // $data=array_merge($data,array(
    //     'act'=>'disable_activity',
    //     'user_id'=>$user_id, //会员idactivity
    //     'act_id'=>10,       // 活动id
    // ));
    // 我的活动-提交选择商品
    // $data=array_merge($data,array(
    //     'act'=>'add_activity',
    //     'user_id'=>$user_id, //会员idactivity
    //     // 'goods_list'=>array(
    //     //         array('goods_id'=>12,'price'=>453,'number'=>2),
    //     //         array('goods_id'=>13,'price'=>455,'number'=>3),
    //     //     ),        // 多维数组，产品信息 goods_id,price,number
    //     'goods_list'=>'[{"price":"123","goods_id":"210","number":"11"},{"price":"123","goods_id":"211","number":"22"}]', //产品信息 json格式 [{"goods_id":"211","price":"123"},{"goods_id":"211","price":"123"}]
    //     'act_name'=>'活动名称',       // 活动名称
    //     'start_time'=>'2009-10-21 16:00:10', // 活动开始 2009-10-21 16:00:10
    //     'end_time'=>'2017-12-21 16:00:10', // 活动结束
    //     'act_number'=>'2',        // 优惠码使用次数
    //     'country_id'=>'2',        // 国家库id
    // ));
    // 我的活动-选择商品
    // $data=array_merge($data,array(
    //     'act'=>'activity',
    //     'user_id'=>$user_id, //会员idactivity
    //     'country_id'=>'3', // 国家库id，虚拟库为0
    //     'country_id'=>'139', // 国家库id，虚拟库为0
    //     'page'=>'1', // 页数
    // ));
    // 我的活动-选择商品-再来一单
    // $data=array_merge($data,array(
    //     'act'=>'activity_again',
    //     'user_id'=>$user_id, //会员idactivity
    //     'act_id'=>'1167', // 原活动id
    //     'page'=>'1', // 页数
    // ));
    // 我的活动-选择国家库
    // $data=array_merge($data,array(
    //     'act'=>'activity_coutry',
    //     'user_id'=>$user_id, //会员id
    // ));
    // 我的代理-我的代理列表
    // $data=array_merge($data,array(
    //     'act'=>'my_agent',
    //     'user_id'=>$user_id, //会员id
    //     'page'=>3, //页数
    // ));
    // $data=array_merge($data,array(
    //     'act'=>'test',
    //     'user_id'=>$user_id, //会员id
    //     'page'=>1, //页数
    // ));
    // 我的代理-我的代理备注名称
    // $data=array_merge($data,array(
    //     'act'=>'agent_bei',
    //     'user_id'=>$user_id, //会员id
    //     'agent_id'=>6, //代理序列id
    //     'nice_name'=>'fu', //备注名
    // ));
    // 我的代理-查看订单
    // $data=array_merge($data,array(
    //     'act'=>'agent_order',
    //     'user_id'=>$user_id, //会员id
    //     'agent_id'=>278, //代理会员id
    //     'page'=>1, //页数
    // ));
    // 我的代理-删除
    // $data=array_merge($data,array(
    //     'act'=>'agent_del',
    //     'user_id'=>$user_id, //会员id
    //     'agent_id'=>93, //代理会员id
    // ));
    // 我的代理-成本上浮比例列表
    // $data=array_merge($data,array(
    //     'act'=>'my_scale',
    //     'user_id'=>$user_id, //会员id
    //     'agent_id'=>428, //代理会员id
    //     'page'=>3, //代理会员id
    // ));
    // 我的代理-设置具体商品成本上浮比例
    // $data=array_merge($data,array(
    //     'act'=>'set_scale_goods',
    //     'user_id'=>$user_id, //会员id
    //     'agent_id'=>93, //代理会员id
    //     'scale'=>12, //统一设置上浮比例时传
    //     // 'goods_list'=>'[{"goods_id" : "210",   "scale" : "112"  },{"goods_id" : "219",   "scale" : "111"  }]', //产品上浮信息 json格式 [{"goods_id":"1","scale":"20"},{"goods_id":"2","scale":"10"}]
    // ));
    // 邀请码管理
    // $data=array_merge($data,array(
    //     'act'=>'get_code',
    //     'user_id'=>$user_id, //会员id
    // ));
    // 常售商品列表
    // $data=array_merge($data,array(
    //     'act'=>'common_goods_list',
    //     'user_id'=>$user_id, //会员id
    //     'page'=>'', //页数
    // ));
    // 常售商品添加
    // $data=array_merge($data,array(
    //     'act'=>'common_goods_add',
    //     'user_id'=>$user_id, //会员id
    //     'goods_list'=>'[  {"price" : "123",   "goods_id" : "211"  }]', //产品信息 json格式 [{"goods_id":"211","price":"123"},{"goods_id":"211","price":"123"}]
    // ));
    // // 常售商品上下架
    // $data=array_merge($data,array(
    //     'act'=>'common_goods_sale',
    //     'user_id'=>$user_id, //会员id
    //     'type'=>'1', //类型 1上架 0下架
    //     'com_id'=>'162', //常售id，多个用逗号隔开
    // ));
    // // 常售商品保存价格
    // $data=array_merge($data,array(
    //     'act'=>'common_goods_price',
    //     'user_id'=>$user_id, //会员id
    //     'com_id'=>'162', //常售id
    //     'price'=>'162', //价格
    // ));
    // // 常售商品删除
    // $data=array_merge($data,array(
    //     'act'=>'common_goods_del',
    //     'user_id'=>$user_id, //会员id
    //     'com_id'=>'162,163,164', //常售id，多个用逗号隔开
    // ));
    // 申请代购
    // $data=array_merge($data,array(
    //     'act'=>'purchasing_apply',
    //     'user_id'=>$user_id, //会员id
    //     'visa'=>'@E:\\www\\test\\test.png;type=image/jpeg', //签证（绿卡）
    //     'proof_residence'=>'@E:\\www\\test\\test.png;type=image/jpeg', //长期居住证明
    //     'location_verification'=>'@E:\\www\\test\\test.png;type=image/jpeg', //所在地核查
    // ));
    // 申请代理
    // $data=array_merge($data,array(
    //     'act'=>'agent_apply',
    //     'user_id'=>$user_id, //会员id
    //     'code'=>'10377', //邀请码
    // ));
    // 用户信息
    // $data=array_merge($data,array(
    //     'act'=>'get_user_info',
    //     'user_id'=>$user_id, //会员id
    // ));
    // 评论
    // $data=array_merge($data,array(
    //     'act'=>'my_comment_detail',
    //     // 'user_id'=>$user_id, //会员id
    //     'rec_id'=>'266', //会员id
    // ));
    // 退款退换货申请列表
    // $data=array_merge($data,array(
    //     'act'=>'back_list',
    //     'type'=>'1', // 固定1 退换货，4 退款
    //     'user_id'=>$user_id, //会员id
    // ));
    // 提交退款/退货接口
    // $data=array_merge($data,array(
    //     'act'=>'back_order_act',
    //     'user_id'=>$user_id, //会员id
    //     'back_type'=>1, // 类型（1：退货，4：退款）
    //     'back_reason'=>'退款原因', //退款原因
    //     'back_postscript'=>'留言内容', //留言内容
    //     'order_id'=>85, //订单id
    //     // 退款
    //     // 'back_pay'=>'1', //退款方式（固定为1）
    //     // 'order_all'=>1, //固定（1）
    //     // // 退货
    //     'tui_goods_price'=>1, //商品金额
    //     'product_id_tui'=>'0', //product_id
    //     'goods_attr_tui'=>'', //商品属性
    //     'order_sn'=>'2016111901298', //订单号
    //     'tui_goods_number'=>'1', //退货商品数量
    //     // 'goods_id'=>'211', //商品id
    //     // 'goods_name'=>'伤风停胶囊', //商品名称
    //     // 'goods_sn'=>'FHGM005', //商品货号
    //     'goods_id'=>'210', //商品id
    //     'goods_name'=>'感冒疏风片', //商品名称
    //     'goods_sn'=>'FHGM004', //商品货号
    // ));
    // 申请退款
    // $data=array_merge($data,array(
    //     'act'=>'back_order',
    //     'user_id'=>$user_id, //会员id
    //     'order_id'=>3155, //订单id
    //     'order_all'=>1, //固定（1）
    // ));
    // 申请退换货
    // $data=array_merge($data,array(
    //     'act'=>'back_order',
    //     'user_id'=>$user_id, //会员id
    //     'order_id'=>83, //订单id
    //     'goods_id'=>210, //商品id
    //     'product_id'=>0, //产品id
    // ));
    // 查看退款/退换货接口
    // $data=array_merge($data,array(
    //     'act'=>'back_order_detail',
    //     'user_id'=>$user_id, //会员id
    //     'back_id'=>18, //退单id
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
    //     'id'=>'102', //收货地址id
    // ));
    // 删除收货地址
    // $data=array_merge($data,array(
    //     'act'=>'drop_consignee',
    //     'user_id'=>$user_id, //会员id
    //     'id'=>'77', //收货地址id
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
    //     // 'act'=>'',
    //     'type'=>3, //类型 0：国家（查省）1：省（查市）2市（查区）
    //     'parent'=>136, //地区id  国家只要中国，id为1，获取省就用type=1&parent=1
    // ));
    // 修改会员头像 user.php
    // $data=array_merge($data,array(
    //     'act'=>'act_edit_img',
    //     'user_id'=>$user_id, //会员id
    //     'headimg'=>'@'.dirname(__FILE__).'\logo.png', //会员头像图片
    // ));
    // 收藏商品列表 user.php
    // $data=array_merge($data,array(
    //     'act'=>'collection_list',
    //     'user_id'=>$user_id, //会员id
    // ));
    // 获取商品分类 category.php
    // $data=array_merge($data,array(
    //     'act'=>'getcat',
    // ));
    // 获取商品列表category.php
    // $data=array_merge($data,array(
    //     'act'=>'get_goods',
    //     // 'user_id'=>$user_id, //会员id（有就传）
    //     'cat_id'=>'', // 商品分类
    //     'sort'=>'', // shop_price（价格），click_count（人气），last_update（更新）
    //     'order'=>'', // ACS（顺序排列），DESC（倒叙排列）
    //     'keywords'=>'', // 搜索是传的值
    //     'page'=>'', // 页数
    // ));
    
    // 热门搜索index.php
    // $data=array_merge($data,array(
    //     'act'=>'search_keywords',
    // ));

    // 获取商品详情
    // $data=array_merge($data,array(
    //     'act'=>'goodsedit',
    //     'goods_id'=>'211', // 商品id
    // ));
    // //获取验证码
    // $data=array_merge($data,array(
    //     'act'=>'send_message',
    //     'phone'=>'13420246245', //手机号码
    //     'send_type'=>'1',  //发送类型（1：注册验证码，2忘记密码验证码）
    // ));
    //注册
    // $data=array_merge($data,array(
    //     'act'=>'register',
    //     'user_name'=>'13560012441', //手机号码
    //     // 'user_name'=>'9025750046', //手机号码
    //     'mobile_code'=>'853160',//验证码
    //     'password'=>'123456',
    //     'confirm_password'=>'123456',
    //     'agreement'=>1,
    //     'user_type'=>'1',//会员类型(1普通会员/2代购会员/3代理会员)
    //     // 'areacode'=>'81',//会员类型(1普通会员/2代购会员/3代理会员)
    //     // 'visa'=>'@E:\\www\\test\\logo.png;type=image/jpeg', //签证（绿卡）
    //     // 'proof_residence'=>'@E:\\www\\test\\aa.png;type=image/jpeg', //长期居住证明
    //     // 'location_verification'=>'@E:\\www\\test\\aa.png;type=image/jpeg', //所在地核查
    //     // 'code'=>'123456', // 邀请码
    // ));
    //获取验证码
    // $data=array_merge($data,array(
    //     'act'=>'send_message',
    //     'phone'=>'13420246245', //手机号码
    //     'send_type'=>'1',//验证码（暂时可不填）
    //     'areacode'=>'86',
    // ));
    // //登录
    // $data=array_merge($data,array(
    //     'act'=>'act_login',
    //     'username'=>'13622222222',
    //     'username'=>'13420246245',
    //     'username'=>'13533074100',
    //     // 'username'=>'9025750046',
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
    //     'username'=>'1234567890',  //用户名
    //     'mobile_phone'=>'13420246245',  //手机号码
    //     'real_name'=>'成铭', //姓名
    // ));
    // // 修改密码
    // $data=array_merge($data,array(
    //     'act'=>'act_edit_password',
    //     'old_password'=>'1234567890',  //原密码
    //     'new_password'=>'123456', //新密码
    //     'confirm_password'=>'123456', //确认密码
    //     'user_id'=>$user_id, //会员id 
    // ));
    // //忘记密码
    // $data=array_merge($data,array(
    //     'act'=>'reset_passwd',
    //     'mobile_phone'=>'13420246245', //手机号码
    //     'mobile_code'=>'adfsd', //验证码
    //     'new_password'=>'1234567890',        //新密码
    //     'confirm_password'=>'1234567890 ',    //确认密码
    // ));
    // 退出//logout
    // $data=array_merge($data,array(
    //     'userAgent'=>'iphone',
    //     'token'=>'8c0990b6949343f15cc388ec8c8cb0c5',
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
    $back=https_request($url,$data,false,'http://localhost/zhida/test/test.php');
print_r($back);exit;
    // if( strpos($back,'"code"') !== false && strpos($back,'msg"') !== false  ){
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
        // $token = strtoupper(md5(urlencode($token)));
        $token = strtoupper(md5($token));
        return $token;
    }
    function _loopArrayToken($param){
        $token = "";
        ksort($param);
        foreach($param as $k=>$v){
            if ($k=='headimg'||$k=='face_card'||$k=='back_card'||$k=='video'||$k=='images0'||$k=='images1'||$k=='visa'||$k=='proof_residence'||$k=='location_verification'||$k=='file') continue;
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
        // curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
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
        foreach ((array) $xmlobject as $key => $value){
            $data[$key] = !is_string($value) ? xmlToArrayElement($value) : $value;
        }
        return $data;
    }
?>