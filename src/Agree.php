<?php

namespace allinpayyst;

use allinpayyst\base\Log;
use allinpayyst\base\PayException;

class Agree extends AllinPay
{
    public function __construct($config = [])
    {
        parent::__construct($config);
        $this->config['apiurl'] .= 'tm/handle';
        $this->config['log_path'] .= 'agree';
    }

    /**
     * @param struct\Agree1050 $params
     * @throws PayException
     */
    public function apply($params)
    {
        try {
            $this->config['transCode'] = '1050';

            $data = [
                'reqTraceNum' => $params->reqTraceNum,
                'signNum' => $params->signNum,
                'memberName' => $params->memberName,
                'agreementType' => $params->agreementType,
                'agreementJson' => $params->agreementJson,
                'jumpPageType' => $params->jumpPageType,
                'jumpUrl' => $params->jumpUrl,
                'notifyUrl' => $params->notifyUrl,
            ];

            return $this->request($data);
        } catch(\Exception $e) {
            Log::Write($this->config['log_path'].'/'.date('Y-m-d').'.log', $e->getMessage(), '异常');
            throw new PayException($e->getMessage());
        }
    }
}