<?php
require '../../vendor/autoload.php';

use allinpayyst\Order;
use allinpayyst\Query;
use allinpayyst\struct\Order2089;
use allinpayyst\struct\Order2090;
use allinpayyst\struct\Order2290;
use allinpayyst\struct\Order2294;
use allinpayyst\struct\Order3001;
use allinpayyst\struct\PayMode;
use allinpayyst\struct\ReceiverList2089;
use allinpayyst\struct\ReceiverList2090;
use allinpayyst\struct\RefundDetail2294;
use allinpayyst\struct\SepDetail2090;
use allinpayyst\struct\termInfo;
use allinpayyst\struct\WechatPublic;

$config = [
    'appId' => '21762000921804636162',
    'secretKey' => '878427523d3525e070298d44481b8d2e'
];

// 退款
//$p = new Order2294();
//$p->reqTraceNum = "A".time();
//$p->orgRespTraceNum = '20240801112028208901265566';
//$p->orderAmount = 1;
//$r = new RefundDetail2294();
//$r->signNum = 'pygc';
//$r->orderAmount = 1;
//$p->refundDetail[] = $r;
//$m = new Order($config);
//$m->refund($p);

// 提现
$p = new Order2290();
$p->reqTraceNum = "A".time();
$p->signNum = 'lvhuaiying';
$p->acctType = '1';
$p->orderAmount = 1;
$p->respUrl = 'http://test.test.pingyao888.cn/index.php';
$p->acctNum = '6230748513042557444';
$m = new Order($config);
$m->withdrawal($p);

// 订单状态查询
//$p = new Order3001();
//$p->respTraceNum = '20240731154100208901265274';
//$m = new Query($config);
//$m->statusQuery($p);

// 担保确认
$p = new Order2090();
$p->reqTraceNum = "A".time();
$p->orgRespTraceNum = '20240801112345208901265572';
$p->respUrl = 'http://test.test.pingyao888.cn/index.php';
$receiver = new ReceiverList2090();
$receiver->signNum = 'pygc';
$receiver->amount = 1;
$receiver->couponAmount = 0;
$sep = new SepDetail2090();
$sep->signNum = 'lvhuaiying';
$sep->amount = 1;
$receiver->sepDetail[] = $sep;
$p->receiverList[] = $receiver;
$m = new Order($config);
$m->orderConfirm($p);

// 担保消费申请
$p = new Order2089();
$p->reqTraceNum = "A".time();
$p->signNum = '123';
$pa = new ReceiverList2089();
$pa->amount = 1;
$pa->signNum = "pygc";
$p->receiverList[] = $pa;
$p->goodsType = '';
$p->bizGoodsNo = '';
$p->orderAmount = 1;
$p->payAmount = 1;
$p->promotionAmount = 0;
$p->respUrl = 'http://test.test.pingyao888.cn/index.php';
$pay = new PayMode();
//$payMode = new $pay->H5CashierVsp;

$payMode = new $pay->CodepayVsp;
$payMode->authcode = '131141916013473785';
$termInfo = new termInfo();
$termInfo->termNo = '11000001';
$termInfo->deviceType = '11';
$termInfo->deviceip = '60.223.244.93';
$payMode->termInfo = $termInfo;

//$payMode = new $pay->WechatPublic;
//$payMode->subAppid = 'wxc70c737b52929cd4';
//$payMode->extendParams = '';
//$payMode->acct = 'oA4PL6td8ZKBchvJoYfEz0Nvu99M';
//$payMode->benefitDetail = '';
$p->payMode = $payMode;
$p->extendParams = '';
$m = new Order($config);
$m->apply($p);
echo '<pre>';
var_dump($payMode);
exit;