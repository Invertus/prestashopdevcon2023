<?php

class PrestashopDevCon extends Module
{
    public function __construct()
    {
        $this->name = 'prestashopdevcon';
        $this->author = 'Invertus';
        parent::__construct();
    }

    public function install()
    {
        return parent::install()
            && $this->registerHook('displayHome')
            && $this->registerHook('displayCheckoutSummaryTop');
    }

    public function hookDisplayHome()
    {
        return "Hello from {$this->name}!";
    }

    public function hookDisplayCheckoutSummaryTop()
    {
        $text = "";
        if ($this->context->controller instanceof OrderControllerCore) {
            $checkourProcess  =$this->context->controller->getCheckoutProcess();
            $text .= "We are currently at step: " . $checkourProcess->getCurrentStep()->getTitle();
        }

        return $text;
    }
}