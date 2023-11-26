<?php

use Dotenv\Dotenv;
use Invertus\Prestashopdevcon\ServiceProvider\ServiceProvider;
use Invertus\Prestashopdevcon\Services\PaymentProvider;

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
            && $this->registerHook('actionDispatcherBefore')
            && $this->registerHook('displayShoppingCartFooter')
            && $this->registerHook('header');
    }

    public function get($serviceName)
    {
        return (new ServiceProvider())->getService($serviceName);
    }

    public function hookHeader()
    {
        return $this->context->smarty->fetch(
            "{$this->getLocalPath()}/views/templates/header.tpl"
        );
    }

    public function hookActionDispatcherBefore()
    {
        include_once _PS_MODULE_DIR_ . $this->name . '/' . "vendor/autoload.php";
        $dotenv = Dotenv::createImmutable($this->getLocalPath());
        $dotenv->load();
    }

    public function hookDisplayHome()
    {
        return $this->context->smarty->fetch(
            "{$this->getLocalPath()}/views/templates/home.tpl"
        );
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

    public function hookDisplayShoppingCartFooter()
    {
        /** @var PaymentProvider $paymentProvider */
        $paymentProvider = $this->get(PaymentProvider::class);

        $this->context->smarty->assign([ "creditCardsNames" => $paymentProvider->getCardNames()]);

        return $this->context->smarty->fetch(
            "{$this->getLocalPath()}/views/templates/cartFooter.tpl"
        );
    }
}