<?php

namespace allinpayyst\base;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Handler\CurlHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\TransferStats;

class Request
{
    protected static $client = null;

    public static $response = null;

    public static $errorInfo = null;

    public static $error = false;

    public static $statucCode = -1;

    public static $responseInfo = [];

    public static $transferTime = null;

    /**
     * 最大重试次数
     */
    const MAX_RETRIES = 5;
    /**
     * 每次请求间隔时间:秒
     */
    const RETRY_DELAY = 2;

    /**
     * 发送请求
     * @param $type string get|post|json
     * @param $url
     * @param $req
     * @param $attach
     */
    public static function send($type, $url, $req = [], $attach = [])
    {
//        $o = new self;
//        $handlerStack = HandlerStack::create(new CurlHandler());
//        $handlerStack->push(Middleware::retry($o->retryDecider(), $o->retryDelay()));

        self::$error = false;
        $attach['timeout'] = $attach['timeout']??3;
        $attach['http_errors'] = false;
        $attach['on_stats'] = [new static, 'handleStats'];

        try{
            self::$client = new Client();

            self::$response = $response = self::$type($url, $req, $attach);

            self::$statucCode = $status = $response->getStatusCode();

            $body = $response->getBody();
            $contents = $body->getContents();

            return $contents;
        }
        catch (\Exception $e){
            self::$errorInfo = $e;
        }

        self::$error = true;

        return null;
    }

    private static function get($url, $req = [], $attach = [])
    {
        $options = [];

        if($req){
            $options['query'] = $req;
        }

        $options = array_merge($options, $attach);

        $res = self::$client->get($url, $options);

        return $res;
    }

    private static function post($url, $req = [], $attach = [])
    {
        $options = [
            'form_params' => $req,
        ];

        $options = array_merge($options, $attach);

        $res = self::$client->post($url, $options);

        return $res;
    }

    private static function multipart($url, $req = [], $attach = [])
    {
        $options = [
            'multipart' => [],
        ];

        foreach ($req as $key => $val){
            $options['multipart'][] = [
                'name' => $key,
                'contents' => $val
            ];
        }
        $res = self::$client->post($url, $options);

        return $res;
    }

    private static function json($url, $req = [], $attach = [])
    {
        $options = [
            'json' => $req,
        ];

        $options = array_merge($options, $attach);

        $res = self::$client->post($url, $options);

        return $res;
    }

    public static function handleStats(TransferStats $stats)
    {
        self::$responseInfo = $stats->getHandlerStats();
        self::$transferTime = $stats->getTransferTime();
    }

    /**
     * retryDecider
     * 返回一个匿名函数, 匿名函数若返回false 表示不重试，反之则表示继续重试
     */
    protected function retryDecider()
    {
        return function (
            $retries,
            Request $request,
            Response $response = null,
            RequestException $exception = null
        ) {
            echo '<pre>';
            var_dump("retryDecider", $retries);
            // 超过最大重试次数，不再重试
            if ($retries >= self::MAX_RETRIES) {
                return false;
            }

            // 请求失败，继续重试
            if ($exception instanceof ConnectException) {
                return true;
            }

            if ($response) {
                // 如果请求有响应，但是状态码大于等于500，继续重试(这里根据自己的业务而定)
                if ($response->getStatusCode() >= 500) {
                    return true;
                }
            }

            return false;
        };
    }

    /**
     * 返回一个匿名函数，该匿名函数返回下次重试的时间（毫秒）
     * @return \Closure
     */
    protected function retryDelay()
    {
        return function ($numberOfRetries) {
            echo '<pre>';
            var_dump("retryDelay", $numberOfRetries);
            return 1000 * self::RETRY_DELAY;
        };
    }
}
