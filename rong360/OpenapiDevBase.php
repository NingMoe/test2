<?php
class OpenapiDevBase
{
	protected $appId = 'xxxxx';
	protected $orgPrivateKey = '-----BEGIN RSA PRIVATE KEY-----
MIICXQIBAAKBgQDo+KrEJXzTp1AtUqg51SLmu8/0NGwn8UNUISu+6IeBxZuEoJGf                                                                      
-----END RSA PRIVATE KEY-----';
	
	protected $rong360Url = 'http://openapi.rong360.com/gateway';
	protected $_toBeSigned  = null;
	protected $_postData    = null;

	public function sendRequest($bizData, $method)
	{/*{{{*/
        $params = array(
            'method'        => $method,
            'app_id'	=> $this->appId,
            'version'	=> '1.0',
            'sign_type'	=> 'RSA',
            'format'	=> 'json',
            'timestamp'	=> time()
        );
        $params['biz_data'] = json_encode($bizData);

        $this->_toBeSigned = $this->getSignContent($params);
        $params['sign'] = $this->sign($this->_toBeSigned);

        $resp = $this->_crulPost($params, $this->rong360Url);
        return ($resp);
	}/*}}}*/
    
    protected function getSignContent($params)
    {/*{{{*/
    	ksort($params);
    
    	$i = 0; 
    	$stringToBeSigned = "";
    	foreach ($params as $k => $v) {
    		if ($i == 0) {
    			$stringToBeSigned .= "$k" . "=" . "$v";
    		} else {
    			$stringToBeSigned .= "&" . "$k" . "=" . "$v";
    		}
    		$i++;
    	}
    	unset ($k, $v);
    	return $stringToBeSigned;
    }/*}}}*/
    
    protected function sign($data) 
    {/*{{{*/
    	$res = $this->orgPrivateKey;
        $sign='';
    	openssl_sign($data, $sign, $res);
    	$sign = base64_encode($sign);
    	return $sign;
    }/*}}}*/
    
    private function _crulPost($postData, $url='')
    {/*{{{*/
    	if(empty($url)){
    		return false;
    	}
    
        try
        {
            $this->_postData = http_build_query($postData);
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $this->_postData);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($curl, CURLOPT_SSLVERSION, 1);
            curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 10);
            curl_setopt($curl, CURLOPT_TIMEOUT, 30);
            $res = curl_exec($curl);

            $errno = curl_errno($curl);
            $curlInfo = curl_getinfo($curl);
            $errInfo = 'curl_err_detail: ' . curl_error($curl);
            $errInfo .= ' curlInfo:'. json_encode($curlInfo);

            $arrRet = json_decode($res, true);

            //统一记录日志
            $logLevel = 'info';
            if(!is_array($arrRet) || $arrRet['error']!=200) {
                $logLevel = 'warning';
            }
            curl_close($curl);
        }catch(Exception $e)
            {
                print_r($e->getMessage());
            }
    
    
    	if($arrRet['errno']==0){
    		return $arrRet;
    	}

    	return $arrRet;
    }/*}}}*/
}
