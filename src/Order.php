<?php

namespace allinpayyst;

use allinpayyst\base\Log;
use allinpayyst\base\PayException;

class Order extends AllinPay
{
    public function __construct($config = [])
    {
        parent::__construct($config);
        $this->config['apiurl'] .= 'tx/handle';
        $this->config['log_path'] .= 'order';
    }

    /**
     * @param struct\Order2089 $params
     * @throws PayException
     */
    public function apply($params)
    {
        try {
            $this->config['transCode'] = '2089';

            $data = [
                'reqTraceNum' => $params->reqTraceNum,
                'signNum' => $params->signNum,
                'receiverList' => json_encode($params->receiverList),
                'goodsType' => $params->goodsType,
                'bizGoodsNo' => $params->bizGoodsNo,
                'orderAmount' => $params->orderAmount,
                'payAmount' => $params->payAmount,
                'promotionAmount' => $params->promotionAmount,
                'reqsUrl' => $params->reqsUrl,
                'respUrl' => $params->respUrl,
                'orderValidTime' => $params->orderValidTime,
                'payMode' => json_encode([$params->payMode->getMode() => $params->payMode]),
                'goodsName' => $params->goodsName,
                'goodsDesc' => $params->goodsDesc,
                'summary' => $params->summary,
                'extendParams' => $params->extendParams,
            ];

            return $this->request($data);
        } catch(\Exception $e) {
            Log::Write($this->config['log_path'].'/'.date('Y-m-d').'.log', $e->getMessage(), '异常');
            throw new PayException($e->getMessage());
        }
    }

    /**
     * @param struct\Order2090 $params
     * @throws PayException
     */
    public function orderConfirm($params)
    {
        try {
            $this->config['transCode'] = '2090';

            $data = [
                'reqTraceNum' => $params->reqTraceNum,
                'orgReqTraceNum' => $params->orgReqTraceNum,
                'oriTransDate' => $params->oriTransDate,
                'orgRespTraceNum' => $params->orgRespTraceNum,
                'receiverList' => $params->receiverList,
                'respUrl' => $params->respUrl,
                'summary' => $params->summary,
                'extendParams' => $params->extendParams,
            ];

            return $this->request($data);
        } catch(\Exception $e) {
            Log::Write($this->config['log_path'].'/'.date('Y-m-d').'.log', $e->getMessage(), '异常');
            throw new PayException($e->getMessage());
        }
    }

    /**
     * @param struct\Order2290 $params
     * @throws PayException
     */
    public function withdrawal($params)
    {
        try {
            $this->config['transCode'] = '2290';

            $data = [
                'reqTraceNum' => $params->reqTraceNum,
                'signNum' => $params->signNum,
                'acctType' => $params->acctType,
                'payAcctNo' => $params->payAcctNo,
                'orderAmount' => $params->orderAmount,
                'couponAmount' => $params->couponAmount,
                'respUrl' => $params->respUrl,
                'payMode' => $params->payMode,
                'receiveAcctType' => $params->receiveAcctType,
                'acctNum' => $params->acctNum,
                'withdrawType' => $params->withdrawType,
                'summary' => $params->summary,
                'extendParams' => $params->extendParams,
            ];

            return $this->request($data);
        } catch(\Exception $e) {
            Log::Write($this->config['log_path'].'/'.date('Y-m-d').'.log', $e->getMessage(), '异常');
            throw new PayException($e->getMessage());
        }
    }

    /**
     * @param struct\Order2294 $params
     * @throws PayException
     */
    public function refund($params)
    {
        try {
            $this->config['transCode'] = '2294';

            $data = [
                'reqTraceNum' => $params->reqTraceNum,
                'orgRespTraceNum' => $params->orgRespTraceNum,
                'orderAmount' => $params->orderAmount,
                'promotionAmount' => $params->promotionAmount,
                'refundDetail' => $params->refundDetail,
                'isFundAllocation' => $params->isFundAllocation,
                'respUrl' => $params->respUrl,
                'chnlDiscAmt' => $params->chnlDiscAmt,
                'extendParams' => $params->extendParams,
            ];

            return $this->request($data);
        } catch(\Exception $e) {
            Log::Write($this->config['log_path'].'/'.date('Y-m-d').'.log', $e->getMessage(), '异常');
            throw new PayException($e->getMessage());
        }
    }
}