<?php

namespace allinpayyst;

use allinpayyst\base\Log;
use allinpayyst\base\PayException;

class Query extends AllinPay
{
    public function __construct($config = [])
    {
        parent::__construct($config);
        $this->config['apiurl'] .= 'tq/handle';
        $this->config['log_path'] .= 'query';
    }

    /**
     * @param struct\Order3001 $params
     * @throws PayException
     */
    public function statusQuery($params)
    {
        try {
            $this->config['transCode'] = '3001';

            $data = [
                'respTraceNum' => $params->respTraceNum,
                'reqTraceNum' => $params->reqTraceNum,
                'oriTransDate' => $params->oriTransDate,
            ];

            return $this->request($data);
        } catch(\Exception $e) {
            Log::Write($this->config['log_path'].'/'.date('Y-m-d').'.log', $e->getMessage(), '异常');
            throw new PayException($e->getMessage());
        }
    }
}