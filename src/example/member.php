<?php
require '../../vendor/autoload.php';

use allinpayyst\Member;
use allinpayyst\Order;
use allinpayyst\struct\bankAcctDetail;
use allinpayyst\struct\enterpriseBaseInfo;
use allinpayyst\struct\Member1010;
use allinpayyst\struct\Member1020;
use allinpayyst\struct\Member1023;
use allinpayyst\struct\Member1027;
use allinpayyst\struct\Member1030;
use allinpayyst\struct\Member1032;
use allinpayyst\struct\Order2089;
use allinpayyst\struct\PayMode;
use allinpayyst\struct\payModeWechatPublic;
use allinpayyst\struct\receiverList;

$key = '878427523d3525e070298d44481b8d2e';
$data = '142431199608110313';

$config = [
    'appId' => '21762000921804636162',
    'secretKey' => '878427523d3525e070298d44481b8d2e'
];

$p = new Member1023();
$p->signNum = 'lvhuaiying';
$p->acctType = '01';
$m = new Member($config);
$r = $m->balance($p);

$p = new Member1020();
$p->reqTraceNum = "A".time();
$p->signNum = "pygc";
$p->memberRole = "收款方";
$p->notifyUrl = 'http://test.test.pingyao888.cn/index.php';
$baseInfo = new enterpriseBaseInfo();
$baseInfo->enterpriseName = '竹溪县子怡鞋店';
$baseInfo->enterpriseNature = '1';
$baseInfo->addressCode = '140728';
$baseInfo->enterpriseAdress = '山西省晋中市平遥县';
$baseInfo->unifiedSocialCredit = '92420324MA4D68J28J';
$baseInfo->busLicenseValidate = '9999-12-31';
$baseInfo->legalPersonName = '王三华';
$baseInfo->legalPersonCerType = '1';
$baseInfo->legalPersonCerNum = '420324197711160623';
$baseInfo->legalPersonPhone = '17635435725';
$p->enterpriseBaseInfo = $baseInfo;
$bankInfo = new bankAcctDetail();
$bankInfo->acctAttr = "1";
$bankInfo->acctNum = "6230748513042557444";
$bankInfo->openBankNo = "01020000";
$bankInfo->openBankBranchName = "中国工商银行股份有限公司北京樱桃园支行";
$bankInfo->payBankNumber = "123456789123";
$bankInfo->openBankProvince = "山西省";
$bankInfo->openBankCity = "晋中市";
$p->bankAcctDetail = $bankInfo;
$m = new Member($config);
$r = $m->account($p);



$p = new Member1032();
$p->reqTraceNum = "A".time();
$p->signNum = 'pygc';
$p->applyRespTraceNum = '20240727095840103000304206';
$p->phone = '17635435725';
$p->verifyCode = '111111';
$m = new Member($config);
$r = $m->phoneBindConfirm($p);


$p = new Member1030();
$p->reqTraceNum = "A".time();
$p->signNum = 'pygc';
$p->phone = '17635435725';
$p->phoneType = '1';
$p->jumpUrl = '';
$p->notifyUrl = 'http://test.test.pingyao888.cn/index.php';
$p->authPerInfo = '';
$m = new Member($config);
$r = $m->phoneBind($p);

$p = new Member1010();
$p->reqTraceNum = "A".time();
$p->signNum = 'lvhuaiying';
$p->memberRole = '分账方';
$p->name = '吕怀颖';
$p->cerType = '1';
$p->cerNum = '140702199606187061';
$p->acctNum = '6230748513042557444';
$p->phone = '18434755542';
$p->bindType = '8';
$m = new Member($config);
$r = $m->apply($p);

$p = new Member1027();
$p->reqTraceNum = "A".time();
$p->signNum = 'pygc';
$p->infoType = "8";
$m = new Member($config);
$r = $m->query($p);

