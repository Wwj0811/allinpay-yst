<?php
namespace allinpayyst\base;

class AppUtil{
    public static function Sign(array $array, $url)
    {
        // TODO 调用接口获取签名
        $res = Request::send("json", $url, [
            'text' => self::ToUrlParams($array)
        ]);
        if($res){
            $res = json_decode($res, true);
            if($res['code'] == 0){
                return $res['sign'];
            }
        }
        return "";
    }
	
	/**
	 * 拼接签名字符串
	 */
	public static function ToUrlParams(array $array)
	{
        ksort($array);
		$buff = "";
		foreach ($array as $k => $v)
		{
			if($v != "" && !is_array($v)){
				$buff .= $k . "=" . $v . "&";
			}
		}
		
		$buff = trim($buff, "&");
		return $buff;
	}
	
	/**
	 * 校验签名
	 * @param array 参数
	 * @param bool appkey
	 */
    public static function ValidSign(array $array, string $public_key)
    {
        $sign =$array['sign'];
        unset($array['sign']);
        ksort($array);
        $bufSignSrc = AppUtil::ToUrlParams($array);
        $public_key = chunk_split($public_key , 64, "\n");
        $key = "-----BEGIN PUBLIC KEY-----\n$public_key-----END PUBLIC KEY-----\n";
        $result= openssl_verify($bufSignSrc,base64_decode($sign), $key );
        return $result;
    }
	
	/**
	 * 
	 * 产生随机字符串，不长于32位
	 * @param int $length
	 * @return string 产生的随机字符串
	 */
	public static function GetNonceStr($length = 32) 
	{
		$chars = "abcdefghijklmnopqrstuvwxyz0123456789";  
		$str ="";
		for ( $i = 0; $i < $length; $i++ )  {  
			$str .= substr($chars, mt_rand(0, strlen($chars)-1), 1);  
		} 
		return $str;
	}

    public static function Sm4EncryptEcb($key, $data)
    {
        return bin2hex(openssl_encrypt($data, "sm4-ecb", hex2bin($key), OPENSSL_RAW_DATA));
    }

    public static function DeepFilterNulls(array $array) {
        $result = [];
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                // 如果是数组，递归调用函数
                $filteredValue = self::deepFilterNulls($value);
                if (!empty($filteredValue)) {
                    // 只有当过滤后的数组不为空时才添加到结果中
                    $result[$key] = $filteredValue;
                }
            } elseif (is_object($value)) {
                // 如果是对象，转换为数组
                $filteredValue = self::deepFilterNulls((array) $value);
                if (!empty($filteredValue)) {
                    // 只有当过滤后的数组不为空时才添加到结果中
                    $result[$key] = $filteredValue;
                }
            } else {
                // 如果不是null，添加到结果中
                if ($value !== null) {
                    $result[$key] = $value;
                }
            }
        }
        return $result;
    }
}
