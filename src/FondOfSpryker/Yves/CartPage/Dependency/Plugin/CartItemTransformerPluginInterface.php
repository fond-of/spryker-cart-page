<?php

namespace FondOfSpryker\Yves\CartPage\Dependency\Plugin;

use Generated\Shared\Transfer\QuoteTransfer;

interface CartItemTransformerPluginInterface
{
    /**
     * @api
     *
     * @param array<\Generated\Shared\Transfer\ItemTransfer> $cartItems
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     * @param string $locale
     *
     * @return array<\Generated\Shared\Transfer\ItemTransfer>
     */
    public function transformCartItems(array $cartItems, QuoteTransfer $quoteTransfer, string $locale): array;
}
