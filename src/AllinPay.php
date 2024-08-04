<?php

namespace allinpayyst;


use allinpayyst\base\AppUtil;
use allinpayyst\base\Log;
use allinpayyst\base\PayException;
use allinpayyst\base\Request;

class AllinPay
{
    protected $config = array(
        'apiurl' => 'http://116.228.64.55:28082/yst-service-api/',
        'format' => 'json',
        'charset' => 'UTF-8',
        'signType' => 'SM3withSM2',
        'version' => '1.0',
        'transCode' => '',
        // 日志目录
        'log_path' => '',
        'signUrl' => 'http://localhost:8111/sign',
    );

    public function __construct($config = [])
    {
        $this->config = array_merge($this->config, $config);
        // 接口地址
        if(empty($this->config["apiurl"]))
        {
            throw new PayException("apiurl 参数错误");
        }
        // 应用ID
        if(empty($this->config["appId"]))
        {
            throw new PayException("appId 参数错误");
        }
    }

    public function request($data)
    {
        $data = AppUtil::DeepFilterNulls($data);
        $req = [
            'appId' => $this->config['appId'],
            'charset' => $this->config['charset'],
            'format' => $this->config['format'],
            'spAppId' => '',
            'transCode' => $this->config['transCode'],
            'transDate' => date('Ymd'),
            'transTime' => date('His'),
            'version' => $this->config['version'],
            'bizData' => json_encode($data, JSON_UNESCAPED_UNICODE)
        ];

        $req['sign'] = AppUtil::Sign($req, $this->config['signUrl']);
        $req['signType'] = $this->config['signType'];

        Log::Write($this->config['log_path'].'/'.date('Y-m-d').'.log', $req, '请求参数');
        $res = Request::send("json", $this->config['apiurl'], $req);
        Log::Write($this->config['log_path'].'/'.date('Y-m-d').'.log', $res, '返回结果');
        $res = json_decode($res, true);
        if($res){
            if($res['code'] == '00000'){
                $bizData = $res['bizData']??'';
                if(is_string($bizData)){
                    $bizData = json_decode($bizData, true);
                }
                return $bizData;
            }
        }
        throw new PayException("调用失败：".$res["msg"]??'');
    }
}