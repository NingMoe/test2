<?php
/**
 * 新版接口基类
 */
class ApiControl
{
    protected $secret = "";
    protected $api_key = "";
    protected $host = "";

    public function  __construct($secret,$api_key,$host,$host_test,$debug=1)
    {
        $this->secret = $secret;
        $this->api_key = $api_key;
        if($debug)
            $this->host = $host_test;
        else
            $this->host = $host;
    }
    public function get_dates($data)
    {
        if(isset($data['act'])){
            switch ($data['act']) {
                case 'act_login':  //会员登陆
                case 'register':  //会员注册
                case 'send_message':  //发送验证码
                case 'get_user_info':  //获取会员信息
                case 'act_edit_profile':  //修改个人资料的处理
                case 'act_edit_img':  //修改头像
                case 'act_edit_password':  //修改会员密码
                case 'reset_passwd':  //找回密码
                case 'my_message':  //我的信息
                case 'my_message_details':  //我的消息详情
                case 'my_message_del':  //我的消息删除
                case 'get_cart_count':  //获取购物车数量
                case 'order_list':  //我的订单
                case 'order_detail'://订单详情
                case 'cancel_order'://取消订单
                case 'affirm_received'://确认收货
                case 'back_list'://退款退货列表
                case 'back_order'://申请退款退货
                case 'back_order_act'://申请退款退货
                case 'address_list'://收货地址列表
                case 'act_edit_address'://添加/编辑收货地址
                case 'drop_consignee'://删除收货地址
                case 'act_address_default'://设置默认收货地址
                case 'collection_list'://收藏商品列表
                case 'bonus'://我的红包列表
                case 'my_comment'://商品评价/晒单
                case 'my_comment_send'://提交商品评论
                    $url=$this->host.'user.php';
                    break;
                case 'getcat'://获取分类
                case 'get_goods'://商品列表
                    $url=$this->host.'category.php';
                    break;
                case 'get_cart'://购物车列表
                case 'addcart'://加入购物车
                case 'delete_cart'://删除购物车指定信息
                case 'clear'://清空购物车
                case 'update_group_cart'://修改购物车数量
                    $url=$this->host.'cart.php';
                    break;
                case 'goodsedit'://商品详情
                    $url=$this->host.'goods.php';
                    break;
                case 'get_exchange_list'://积分商城列表
                case 'get_exchange_goods_view'://积分商城详情
                case 'add_exchange_cart'://积分商城加入购物车
                    $url=$this->host.'exchange.php';
                    break;
                case 'get_region'://获取地区
                    $url=$this->host.'region.php';
                    break;
                default:
                    $url=$this->host.'index.php';
                    break;
            }
        }else{
            $url=$this->host.'index.php';
        }
        $data['api_key']=$this->api_key;
        $data['api_sign']=$this->_getSign($url,$data);
        return $this->https_request($url,$data);
    }

    protected function _getSign($url, $param)
    {
        // 参数拼凑
        $get=array();
        if(strpos($url,'?') !== false){
            foreach(explode('&',substr($url,strpos($url,'?')+1)) as $v){
                $tem=explode('=',$v);
                $get[$tem['0']]=$tem['1'];
            }
        }
        $param=array_merge($get,$param);

        $token = $this->secret;
        $token .= $this->_loopArrayToken($param);
        $token .= $this->secret;
        $this->_token_before_md5 = $token;
        $token = strtoupper(md5(urlencode($token)));
        return $token;
    }

    protected function _loopArrayToken($param){
        $token = "";
        ksort($param);
        foreach($param as $k=>$v){
            if(is_array($v)){
                $token .="{$k}";
                $token .= $this->_loopArrayToken($v);
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
    public function https_request($url,$data = '',$ssl=false,$referer=false,$parm_cookie=array('use'=>false)){
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
    public function getCookie($curl,$pram){
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
}