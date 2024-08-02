<?php

namespace allinpayyst\struct;

class PayMode
{
    public $WechatPublic = WechatPublic::class;
    public $CodepayVsp = CodepayVsp::class;
    public $H5CashierVsp = H5CashierVsp::class;
}

class WechatPublic
{
    public $vspCusid = '';
    public $subAppid = '';
    public $extendParams = '';
    public $acct = '';
    public $limitPay = '';
    public $goodsTag = '';
    public $benefitDetail = benefitDetail::class;
    public $chnlStoreid = '';
    public $subBranch = '';
    public $cerNum = '';
    public $name = '';
    public $cerType = '';
    public function getMode(): string
    {
        return 'WECHAT_PUBLIC';
    }
}

class benefitDetail
{
    public $cost_price = '';
    public $receipt_id = '';
    public $goods_detail = [];
}

class CodepayVsp
{
    public $vspCusid = '';
    public $limitPay = '';
    public $authcode = '';
    public $extendParams = '';
    public $fqNum = '';
    public $goodsTag = '';
    public $benefitDetail = benefitDetail::class;
    public $chnlStoreid = '';
    public $subBranch = '';
    public $termInfo = termInfo::class;
    public function getMode(): string
    {
        return 'CODEPAY_VSP';
    }
}

class H5CashierVsp
{
    public function getMode(): string
    {
        return 'H5_CASHIER_VSP';
    }
}

class termInfo
{
    public $termNo = '';
    public $deviceType = '';
    public $termsn = '';
    public $longitude = '';
    public $latitude = '';
    public $deviceip = '';
    public $encryptrandnum = '';
    public $secrettext = '';
    public $appversion = '';
}