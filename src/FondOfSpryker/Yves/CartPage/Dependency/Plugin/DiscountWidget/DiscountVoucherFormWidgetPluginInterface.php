<?php

namespace FondOfSpryker\Yves\CartPage\Dependency\Plugin\DiscountWidget;

interface DiscountVoucherFormWidgetPluginInterface
{
    const NAME = 'DiscountVoucherFormWidgetPlugin';

    /**
     * @param \ArrayObject|null $data
     */
    public function initialize(?\ArrayObject $data): void;
}