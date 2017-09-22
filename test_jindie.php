<?php
/*
    php Cloud 系统集成 WebAPI方式 销售出库单 完整示例
    by wanghl 2015-12-02
    change by name time
    提高程序运行效率 代码中“ ->' 双引号改为单引号
    
    测试环境 Cloud5.0
    代码中Josn字串中数据是依据蓝海机械演示帐套业务数据进行构造。
    即使用还原的蓝海机械演示帐套，可以直接通过本Json字串进行导入测试。
    如是自己实际业务库的业务数据，可根据实际情况，进行替换即可。
                    
    在php的运行环境中Copy如下代码即可运行成功
    php.ini 需要开放 extension=php_curl.dll
    
    php下载地址：
    http://windows.php.net/download/
    iis+php 下相关配置
    http://jingyan.baidu.com/article/ff42efa97b0f96c19e22023b.html
    http://jingyan.baidu.com/article/6b97984d9fe9e91ca2b0bf3c.html
*/
//phpinfo();
//K/3 Cloud 业务站点地址
$cloudUrl = "http://dgstar.test.ik3cloud.com/K3Cloud/";

//登陆参数
$data = array(      
    '5926a3bc4fb2cc',//帐套Id
    'Administrator',//用户名
    '1q2w#E$R',//密码
    2052//语言标识
);

//定义记录Cloud服务端返回的Session
$cookie_jar = tempnam('./tmp','CloudSession');  
$post_content = create_postdata($data);

$result = invoke_login($cloudUrl,$post_content,$cookie_jar);

//$array = json_decode($result,true);
header("Content-type: text/html; charset=utf8");
// print_r($cookie_jar);exit;
// echo '<pre>';print_r('登陆请求数据：');
// echo '<pre>';print_r($post_content);

// echo '<pre>';print_r('登陆返回结果：'); 
//     echo '<pre>';print_r($result); 

// $data_model = '{"Creator":"String","NeedUpDateFields":[],"Model":{"FID":0,"FBillTypeID":{"FBillTypeID":"","FNUMBER":"XSCKD01_SYS"},"FSaleOrgId":{"FOrgID":0,"FNUMBER":"103"},"FCustomerID":{"FCUSTID":0,"FNUMBER":"CUST0002"},"FStockOrgId":{"FOrgID":0,"FNUMBER":"101.2"},"FOwnerIdHead":{"FItemID":0,"FNUMBER":"103"},"FNote":"","SAL_OUTSTOCK__FEntity":[{"FMaterialID":{"FNumber":"1.01.001"},"FUnitID":{"FNumber":"Pcs","FName":""},"FStockID":{"FNumber":"CK001"},"FStockStausID":{"FNumber":"KCZT01_SYS"},"FMustQty":1,"FRealQty":1,"FAmount":0,"FPrice":0,"FTaxPrice":0,"FDiscount":0,"FDiscountRate":0,"FIsFree":true,"FLot":{"FNUMBER":"0000"}}],"SAL_OUTSTOCK__SubHeadEntity":{"FSettleCurrID":{"FCURRENCYID":0,"FNumber":"PRE001"},"FLocalCurrID":{"FCURRENCYID":0,"FNumber":"PRE001"},"FSettleOrgID":{"FOrgID":0,"FNumber":"103"},"FExchangeTypeID":{"FRATETYPEID":0,"FNumber":"HLTX01_SYS"},"FExchangeRate":"1","FBillAllAmount":0}}}';
// $data_model = array
// (
// 'CreateOrgId' => 0,
// 'Number' => '10.01',
// 'Id' => ''
// );
// $data_model = '{"CreateOrgId":"0","Number":"0001","Id":""}';

$data_model = '{"CreateOrgId":"0","Number":"10.01.001","Id":""}';
$data = array(      
    'BD_MATERIAL',//业务对象标识FormId
    $data_model//具体Json字串
);

$post_content = create_postdata($data);
$result = invoke_save($cloudUrl,$post_content,$cookie_jar);

//$array = json_decode($result,true);  
// echo '<pre>';print_r('请求数据：'); 
// echo '<pre>';print_r($post_content); 
print_r($result);exit;

//登陆
function invoke_login($cloudUrl,$post_content,$cookie_jar)
{

        $loginurl = $cloudUrl.'Kingdee.BOS.WebApi.ServicesStub.AuthService.ValidateUser.common.kdsvc';

        return invoke_post($loginurl,$post_content,$cookie_jar,TRUE);
}

//保存
function invoke_save($cloudUrl,$post_content,$cookie_jar)
{
        $invokeurl = $cloudUrl.'Kingdee.BOS.WebApi.ServicesStub.DynamicFormService.Save.common.kdsvc';
        return invoke_post($invokeurl,$post_content,$cookie_jar,FALSE);
}

//审核
function invoke_audit($cloudUrl,$post_content,$cookie_jar)
{
        $invokeurl = $cloudUrl.'Kingdee.BOS.WebApi.ServicesStub.DynamicFormService.Audit.common.kdsvc';
        return invoke_post($invokeurl,$post_content,$cookie_jar,FALSE);
}

function invoke_post($url,$post_content,$cookie_jar,$isLogin)
{
        $ch = curl_init($url);

        $this_header = array(
                'Content-Type: application/json',
                'Content-Length: '.strlen($post_content)
        );
        
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_HTTPHEADER, $this_header);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_content);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        if($isLogin){
                curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_jar);
        }
        else{
                curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_jar);
        }
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
          
        $result = curl_exec($ch); 
        curl_close($ch);  
        
        return $result;
}

//构造Web API请求格式
function create_postdata($args) {
     $postdata = array(
            'format'=>1,
        'useragent'=>'ApiClient',
        'rid'=>create_guid(),
        'parameters'=>$args,
        'timestamp'=>date('Y-m-d'),
        'v'=>'1.0'
    );
    return json_encode($postdata);
}

//生成guid
function create_guid() {
    $charid = strtoupper(md5(uniqid(mt_rand(), true)));
    $hyphen = chr(45);// "-"
    $uuid = chr(123)// "{"
    .substr($charid, 0, 8).$hyphen
    .substr($charid, 8, 4).$hyphen
    .substr($charid,12, 4).$hyphen
    .substr($charid,16, 4).$hyphen
    .substr($charid,20,12)
    .chr(125);// "}"
    return $uuid;
}
?>