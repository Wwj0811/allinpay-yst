<?php

namespace allinpayyst\struct;

class Member1020
{
    public $reqTraceNum;
    public $signNum;
    public $memberRole;
    public $notifyUrl;
    public $enterpriseBaseInfo;
    public $bankAcctDetail;
}

class enterpriseBaseInfo
{
    /**
     * @var string 企业名称 如有括号，用中文格式（）
     */
    public $enterpriseName = '';

    /**
     * @var string 企业性质：1-企业 2-个体工商户 3-事业单位
     */
    public $enterpriseNature = '';

    /**
     * @var string 地区码
     */
    public $addressCode = '';

    /**
     * @var string 企业地址
     */
    public $enterpriseAdress = '';

    /**
     * @var string 统一社会信用
     */
    public $unifiedSocialCredit = '';

    /**
     * @var string 营业证件有效期
     */
    public $busLicenseValidate = '';
    public $legalPersonName = '';
    public $legalPersonCerType = '';
    public $legalPersonCerNum = '';
    public $idValidateStart = '';
    public $idValidateEnd = '';
    public $legalPersonPhone = '';
}

class bankAcctDetail
{
    public $acctAttr = '';
    public $acctNum = '';
    public $bankReservePhone = '';
    public $openBankNo = '';
    public $openBankBranchName = '';
    public $payBankNumber = '';
    public $openBankProvince = '';
    public $openBankCity = '';
}
