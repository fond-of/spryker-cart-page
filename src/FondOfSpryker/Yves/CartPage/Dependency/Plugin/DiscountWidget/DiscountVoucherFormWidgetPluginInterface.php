<?php

namespace FondOfSpryker\Yves\CartPage\Dependency\Plugin\DiscountWidget;

use ArrayObject;

interface DiscountVoucherFormWidgetPluginInterface
{
    /**
     * @var string
     */
    public const NAME = 'DiscountVoucherFormWidgetPlugin';

    /**
     * @param \ArrayObject $data
     *
     * @return void
     */
    public function initialize(ArrayObject $data): void;
}
