<?php
require '../../vendor/autoload.php';

use allinpayyst\Agree;
use allinpayyst\struct\Agree1050;

$key = '878427523d3525e070298d44481b8d2e';
$data = '142431199608110313';

$config = [
    'appId' => '21762000921804636162',
    'secretKey' => '878427523d3525e070298d44481b8d2e'
];

$p = new Agree1050();
$p->reqTraceNum = "A".time();
$p->signNum = 'pygc';
$p->memberName = '竹溪县子怡鞋店';
$p->agreementType = '1';
$p->agreementJson = '';
$p->jumpPageType = '1';
$p->jumpUrl = '';
$p->notifyUrl = 'http://test.test.pingyao888.cn/index.php';
$m = new Agree($config);
$r = $m->apply($p);

echo '<pre>';
var_dump($r);
exit;
