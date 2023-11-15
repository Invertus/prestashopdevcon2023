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
        return parent::install() && $this->registerHook('displayHome');
    }

    public function hookDisplayHome(): string
    {
        return "Hello from {$this->name}!";
    }
}