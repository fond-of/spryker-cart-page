<?php

namespace FondOfSpryker\Yves\CartPage\Dependency\Plugin\DiscountWidget;

use ArrayObject;

interface DiscountVoucherFormWidgetPluginInterface
{
    public const NAME = 'DiscountVoucherFormWidgetPlugin';

    /**
     * @param  \ArrayObject|null  $data
     *
     * @return void
     */
    public function initialize(?\ArrayObject $data): void;
}
