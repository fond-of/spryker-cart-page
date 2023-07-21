<?php

namespace FondOfSpryker\Yves\CartPage\Dependency\Client;

interface CartPageToLocaleClientInterface
{
    /**
     * @return string
     */
    public function getCurrentLocale(): string;
}
