<?php

namespace FondOfSpryker\Yves\CartPage\Dependency\Plugin\DiscountWidget;

use ArrayObject;

interface DiscountVoucherFormWidgetPluginInterface
{
    const NAME = 'DiscountVoucherFormWidgetPlugin';

    /**
     * @param \ArrayObject|null $data
     */
    public function initialize(ArrayObject $data): void;
}
