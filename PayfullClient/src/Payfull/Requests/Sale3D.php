<?php

namespace Payfull\Requests;

use Payfull\Config;
use Payfull\Validate;
use Payfull\Responses\Responses;

class Sale3D extends Sale
{
    const USE3D = '1';
    private $returnUrl;

    public function __construct(Config $config)
    {
        parent::__construct($config);
    }

    public function setReturnUrl($returnUrl)
    {
        Validate::returnUrl($returnUrl);
        $this->returnUrl = $returnUrl;
    }

    public function getReturnUrl()
    {
        return $this->returnUrl;
    }

    public function execute()
    {
        $this->createRequest();
        $response = self::send($this->endpoint,$this->params);
        return Responses::process3DResponse($response);
    }

    public function createRequest()
    {
        $this->params['return_url'] = $this->returnUrl;
        parent::createRequest();
    }

}