<?php

namespace FondOfSpryker\Yves\CartPage\Plugin;

use Generated\Shared\Transfer\QuoteTransfer;

class LocalizedAbstractAttributesExpanderPlugin implements LocalizedAbstractAttributesExpanderPluginInterface
{
    public function transformCartItems(array $cartItems, QuoteTransfer $quoteTransfer, string $locale): array
    {
        return $cartItems;
    }
}
