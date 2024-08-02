<?php

namespace allinpayyst;

use allinpayyst\base\AppUtil;
use allinpayyst\base\Log;
use allinpayyst\base\PayException;

class Member extends AllinPay
{
    public function __construct($config = [])
    {
        parent::__construct($config);
        $this->config['apiurl'] .= 'tm/handle';
        $this->config['log_path'] .= 'member';
    }

    /**
     * @param struct\Member1010 $params
     * @throws PayException
     */
    public function apply($params)
    {
        try {
            $this->config['transCode'] = '1010';

            $data = [
                'reqTraceNum' => $params->reqTraceNum,
                'signNum' => $params->signNum,
                'memberRole' => $params->memberRole,
                'name' => $params->name,
                'cerType' => $params->cerType,
                'cerNum' => AppUtil::Sm4EncryptEcb($this->config['secretKey'], $params->cerNum),
                'acctNum' => AppUtil::Sm4EncryptEcb($this->config['secretKey'], $params->acctNum),
                'phone' => $params->phone,
                'bindType' => $params->bindType
            ];

            return $this->request($data);
        } catch(\Exception $e) {
            Log::Write($this->config['log_path'].'/'.date('Y-m-d').'.log', $e->getMessage(), '异常');
            throw new PayException($e->getMessage());
        }
    }

    /**
     * @param struct\Member1027 $params
     * @throws PayException
     */
    public function query($params)
    {
        try {
            $this->config['transCode'] = '1027';

            $data = [
                'reqTraceNum' => $params->reqTraceNum,
                'signNum' => $params->signNum,
                'infoType' => $params->infoType,
            ];

            return $this->request($data);
        } catch(\Exception $e) {
            Log::Write($this->config['log_path'].'/'.date('Y-m-d').'.log', $e->getMessage(), '异常');
            throw new PayException($e->getMessage());
        }
    }

    /**
     * @param struct\Member1020 $params
     * @throws PayException
     */
    public function account($params)
    {
        try {
            $this->config['transCode'] = '1020';

            $params->enterpriseBaseInfo->legalPersonCerNum = AppUtil::Sm4EncryptEcb($this->config['secretKey'], $params->enterpriseBaseInfo->legalPersonCerNum);

            $params->bankAcctDetail->acctNum = AppUtil::Sm4EncryptEcb($this->config['secretKey'], $params->bankAcctDetail->acctNum);

            $data = [
                'reqTraceNum' => $params->reqTraceNum,
                'signNum' => $params->signNum,
                'memberRole' => $params->memberRole,
                'notifyUrl' => $params->notifyUrl,
                'enterpriseBaseInfo' => $params->enterpriseBaseInfo,
                'bankAcctDetail' => $params->bankAcctDetail
            ];

            return $this->request($data);
        } catch(\Exception $e) {
            Log::Write($this->config['log_path'].'/'.date('Y-m-d').'.log', $e->getMessage(), '异常');
            throw new PayException($e->getMessage());
        }
    }

    /**
     * @param struct\Member1030 $params
     * @throws PayException
     */
    public function phoneBind($params)
    {
        try {
            $this->config['transCode'] = '1030';

            $data = [
                'reqTraceNum' => $params->reqTraceNum,
                'signNum' => $params->signNum,
                'phone' => $params->phone,
                'phoneType' => $params->phoneType,
                'jumpUrl' => $params->jumpUrl,
                'notifyUrl' => $params->notifyUrl,
                'authPerInfo' => $params->authPerInfo,
            ];

            return $this->request($data);
        } catch(\Exception $e) {
            Log::Write($this->config['log_path'].'/'.date('Y-m-d').'.log', $e->getMessage(), '异常');
            throw new PayException($e->getMessage());
        }
    }

    /**
     * @param struct\Member1032 $params
     * @throws PayException
     */
    public function phoneBindConfirm($params)
    {
        try {
            $this->config['transCode'] = '1032';

            $data = [
                'reqTraceNum' => $params->reqTraceNum,
                'signNum' => $params->signNum,
                'applyRespTraceNum' => $params->applyRespTraceNum,
                'phone' => $params->phone,
                'verifyCode' => $params->verifyCode,
            ];

            return $this->request($data);
        } catch(\Exception $e) {
            Log::Write($this->config['log_path'].'/'.date('Y-m-d').'.log', $e->getMessage(), '异常');
            throw new PayException($e->getMessage());
        }
    }

    /**
     * @param struct\Member1023 $params
     * @throws PayException
     */
    public function balance($params)
    {
        try {
            $this->config['transCode'] = '1023';

            $data = [
                'signNum' => $params->signNum,
                'acctType' => $params->acctType,
            ];

            return $this->request($data);
        } catch(\Exception $e) {
            Log::Write($this->config['log_path'].'/'.date('Y-m-d').'.log', $e->getMessage(), '异常');
            throw new PayException($e->getMessage());
        }
    }
}