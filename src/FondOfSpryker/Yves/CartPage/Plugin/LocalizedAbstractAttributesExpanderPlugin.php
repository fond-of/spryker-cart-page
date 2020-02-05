<?php

namespace FondOfSpryker\Yves\CartPage\Plugin;

use FondOfSpryker\Yves\CartPage\Dependency\Plugin\CartItemTransformerPluginInterface;
use Generated\Shared\Transfer\QuoteTransfer;

class LocalizedAbstractAttributesExpanderPlugin implements CartItemTransformerPluginInterface
{
    public function transformCartItems(array $cartItems, QuoteTransfer $quoteTransfer, string $locale): array
    {
        return $cartItems;
    }
}
