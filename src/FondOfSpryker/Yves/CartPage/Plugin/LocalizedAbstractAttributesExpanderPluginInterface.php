<?php

namespace FondOfSpryker\Yves\CartPage\Plugin;

use Generated\Shared\Transfer\QuoteTransfer;

interface LocalizedAbstractAttributesExpanderPluginInterface
{
    public function transformCartItems(array $cartItems, QuoteTransfer $quoteTransfer, string $locale): array;
}