<?php

namespace allinpayyst\struct;

class Order2294
{
    public $reqTraceNum;
    public $orgRespTraceNum;
    public $orderAmount;
    public $promotionAmount;
    public $refundDetail;
    public $isFundAllocation;
    public $respUrl;
    public $chnlDiscAmt;
    public $extendParams;
}

class RefundDetail2294
{
    public $signNum;
    public $orderAmount;
    public $acctType;
    public $couponAmount;
    public $sepDetail;
}

class SepDetail2294
{
    public $signNum;
    public $amount;
    public $remark;
}