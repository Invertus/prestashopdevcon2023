<?php

use Dotenv\Dotenv;
use Invertus\Prestashopdevcon\ServiceProvider\ServiceProvider;

class PrestashopDevCon extends PaymentModule
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
            && $this->registerHook('displayCheckoutSummaryTop')
            && $this->registerHook('actionDispatcherBefore');
    }

    public function get($serviceName)
    {
        return (new ServiceProvider())->getService($serviceName);
    }

    public function hookActionDispatcherBefore()
    {
        include_once "{$this->getLocalPath()}vendor/autoload.php";

        $dotenv = Dotenv::createImmutable($this->getLocalPath());
        $dotenv->load();
    }

    public function hookDisplayHome()
    {
        return "Hello from {$this->name}!";
    }

    public function hookDisplayCheckoutSummaryTop()
    {
        $text = "";
        if ($this->context->controller instanceof OrderControllerCore && method_exists($this->context->controller, 'getCheckoutProcess')) {
            $checkoutProcess = $this->context->controller->getCheckoutProcess();
            $text .= "We are currently at step: " . $checkoutProcess->getCurrentStep()->getTitle();
        }

        return $text;
    }
}