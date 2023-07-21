<?php

namespace FondOfSpryker\Yves\CartPage\Dependency\Client;

use Spryker\Client\Locale\LocaleClientInterface;

class CartPageToLocaleClientBridge implements CartPageToLocaleClientInterface
{
    /**
     * @var \Spryker\Client\Locale\LocaleClientInterface
     */
    protected LocaleClientInterface $localeClient;

    /**
     * @param \Spryker\Client\Locale\LocaleClientInterface $localeClient
     */
    public function __construct(LocaleClientInterface $localeClient)
    {
        $this->localeClient = $localeClient;
    }

    /**
     * @return string
     */
    public function getCurrentLocale(): string
    {
        return $this->localeClient->getCurrentLocale();
    }
}
