<?php
// +----------------------------------------------------------------------
// | AliSms
// +----------------------------------------------------------------------
// | Author: lintx <lintx@lintx.com>
// +----------------------------------------------------------------------
class AliSms {
/**
* 阿里大鱼(www.alidayu.com)短信发送类
* 使用方法：
---------------------code begin---------------------
$alisms = new AliSms("appkey","secretkey");
$result = $alisms->sign('短信签名')->data(短信模板变量[数组])->code('短信模板ID')->send('短信接收号码');
---------------------code   end---------------------

返回值：
参考 http://open.taobao.com/doc2/apiDetail.htm?spm=a219a.7629065.0.0.h5jQfz&apiId=25450&docType= 的返回示例
但本类去除了第一层无意义数据，并加上status和info两个返回值；status为0表示发送失败，status为1表示发送成功；info在一定程度上可以作为发送结果文本

参数说明：
1.短信签名必须是在阿里大鱼“管理中心-短信签名管理”中的可用签名。如“阿里大鱼”已在短信签名管理中通过审核，则可传入”阿里大鱼“（传参时去掉引号）作为短信签名。短信效果示例：【阿里大鱼】欢迎使用阿里大鱼服务。
2.短信模板变量，传参规则{"key":"value"}，key的名字须和申请模板中的变量名一致，多个变量之间以逗号隔开。示例：针对模板“验证码${code}，您正在进行${product}身份验证，打死不要告诉别人哦！”，传参时需传入{"code":"1234","product":"alidayu"}
  注：官方API使用JSON作为参数，本累中直接使用数组即可，如：["code"=>"1234","product"=>"alidayu"]
3.短信接收号码。支持单个或多个手机号码，传入号码为11位手机号码，不能加0或+86。群发短信需传入多个号码，以英文逗号分隔，一次调用最多传入200个号码。示例：18600000000,13911111111,13322222222
4.短信模板ID，传入的模板必须是在阿里大鱼“管理中心-短信模板管理”中的可用模板。示例：SMS_585014
**/
    //API请求地址
    private $gatewayUrl = "https://eco.taobao.com/router/rest";
    
    //API名称
    private $method="alibaba.aliqin.fc.sms.num.send";
    
    //响应格式
    private $format="json";
    
    //API协议版本
    private $v="2.0";
    
    //签名方式
    private $sign_method="md5";
    
    private $appKey;
    private $secretKey;
    
    //短信类型
    private $sms_type = "normal";
    
    //短信签名
    private $sms_free_sign_name = '';
    
    //短信模板变量
    private $sms_param = array();
    
    //短信接收号码
    private $rec_num = '';
    
    //短信模版ID
    private $sms_template_code = '';
    
    private function _send(){
        $param = array(
            'method'                =>  $this->method,
            'format'                =>  $this->format,
            'app_key'               =>  $this->appKey,
            'timestamp'             =>  date("Y-m-d H:i:s"),
            'v'                     =>  $this->v,
            'sign_method'           =>  $this->sign_method,
            'sms_type'              =>  $this->sms_type,
            'sms_free_sign_name'    =>  $this->sms_free_sign_name,
            'sms_param'             =>  json_encode($this->sms_param),
            'rec_num'               =>  $this->rec_num,
            'sms_template_code'     =>  $this->sms_template_code,
        );
        if(!$this->sms_param){
            unset($param['sms_param']);
        }
        
        $param['sign'] = $this->_sign(array_merge($param));
        $result = $this->_sendSms($param);
        return $result;
    }
    
    private function _sign($param){
        ksort($param);

        $sign = $this->secretKey;
        foreach ($param as $k => $v){
            $sign .= "$k$v";
        }
        $sign .= $this->secretKey;

        return strtoupper(md5($sign));
    }
    
    private function _sendSms($param){
        $url = $this->gatewayUrl . "?" . http_build_query($param);
        $ch = curl_init();
        $timeout = 5;
        curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt ($ch, CURLOPT_URL, $url);
        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        $file_contents = curl_exec($ch);
        curl_close($ch);
        return $file_contents;
    }
    
    public function send($phone=''){
        if($phone!==''){
            $this->phone($phone);
        }
        $result = $this->_send();
        $json = json_decode($result,true);
        if($json!==null){
            foreach($json as $v){
                $json = $v;
            }
        }
        else{
            return array('status'=>0,'info'=>'返回内容解析错误','data'=>$result);
        }
        if($json['code']){
            $json['status'] = 0;
            $json['info'] = $json['sub_msg'];
            return $json;
        }
        else{
            $json['status'] = 1;
            $json['info'] = $json['msg'] ? $json['msg'] : "发送成功";
            return $json;
        }
    }
    
    public function __construct($param1 = "",$param2 = ""){
        if($param1!=="" && $param2!=="" && is_string($param1) && is_string($param2)){
            $this->appkey($param1);
            $this->secret($param2);
        }
    }
    
    public function appkey($appKey=""){
        if($appKey) $this->appKey = $appKey;
        return $this;
    }
    
    public function secret($secretKey=""){
        if($secretKey) $this->secretKey = $secretKey;
        return $this;
    }
    
    public function sign($sign_name = ''){
        $this->sms_free_sign_name = $sign_name;
        return $this;
    }
    
    public function data($data = array()){
        $this->sms_param = $data;
        return $this;
    }
    
    public function phone($phone=''){
        $this->rec_num = $phone;
        return $this;
    }
    
    public function code($code=''){
        $this->sms_template_code = $code;
        return $this;
    }
}
?>