<?php

namespace FondOfSpryker\Yves\CartPage\Controller;

use SprykerShop\Yves\CartPage\Controller\CartController as SprykerShopCartController;

/**
 * @method \FondOfSpryker\Yves\CartPage\CartPageFactory getFactory()
 */
class CartController extends SprykerShopCartController
{
    /**
     * @param array $selectedAttributes
     *
     * @return array
     */
    protected function executeIndexAction(array $selectedAttributes = []): array
    {
        $validateQuoteResponseTransfer = $this->getFactory()
            ->getCartClient()
            ->validateQuote();

        $this->getFactory()
            ->getZedRequestClient()
            ->addResponseMessagesToMessenger();

        $quoteTransfer = $validateQuoteResponseTransfer->getQuoteTransfer();

        $cartItems = $this->getFactory()
            ->createCartItemReaderWithLocale($this->getLocale())
            ->getCartItems($quoteTransfer);

        $itemAttributesBySku = $this->getFactory()
            ->createCartItemsAttributeProvider()
            ->getItemsAttributes($quoteTransfer, $this->getLocale(), $selectedAttributes);

        $quoteClient = $this->getFactory()->getQuoteClient();

        return [
            'cart' => $quoteTransfer,
            'isQuoteEditable' => $quoteClient->isQuoteEditable($quoteTransfer),
            'isQuoteLocked' => $quoteClient->isQuoteLocked($quoteTransfer),
            'cartItems' => $cartItems,
            'attributes' => $itemAttributesBySku,
            'isQuoteValid' => $validateQuoteResponseTransfer->getIsSuccessful(),
        ];
    }
}
