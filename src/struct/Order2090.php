<?php

namespace allinpayyst\struct;

class Order2090
{
    public $reqTraceNum = '';
    public $orgReqTraceNum = '';
    public $oriTransDate = '';
    public $orgRespTraceNum = '';
    public $receiverList = [];
    public $respUrl = '';
    public $summary = '';
    public $extendParams = '';
}

class ReceiverList2090
{
    public $signNum = '';
    public $amount = 0;
    public $couponAmount = 0;
    public $sepDetail = [];
}

class SepDetail2090
{
    public $signNum = '';
    public $amount = 0;
    public $remark = '';
}