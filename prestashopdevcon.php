<?php

use Invertus\Prestashopdevcon\ServiceProvider\ServiceProvider;

class PrestashopDevCon extends PaymentModule
{
    public function __construct()
    {
        $this->name = 'prestashopdevcon';
        $this->author = 'Invertus';
        parent::__construct();

        include_once "{$this->getLocalPath()}vendor/autoload.php";
    }

    public function install()
    {
        return parent::install()
            && $this->registerHook('displayHome')
            && $this->registerHook('displayCheckoutSummaryTop');
    }

    public function get($serviceName)
    {
        return (new ServiceProvider())->getService($serviceName);
    }

    public function hookDisplayHome()
    {
        return "Hello from {$this->name}!";
    }

    public function hookDisplayCheckoutSummaryTop()
    {
        $text = "";
        if ($this->context->controller instanceof OrderControllerCore) {
            $checkoutProcess = $this->context->controller->getCheckoutProcess();
            $text .= "We are currently at step: " . $checkoutProcess->getCurrentStep()->getTitle();
        }

        return $text;
    }
}