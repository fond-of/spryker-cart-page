<?php

namespace FondOfSpryker\Yves\CartPage\Dependency\Plugin\DiscountWidget;

interface DiscountVoucherFormWidgetPluginInterface
{
    public const NAME = 'DiscountVoucherFormWidgetPlugin';

    /**
     * @param \ArrayObject $data
     *
     * @return void
     */
    public function initialize(ArrayObject $data): void;
}
