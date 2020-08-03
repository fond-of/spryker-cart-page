<?php

namespace FondOfSpryker\Yves\CartPage\Model;

use Generated\Shared\Transfer\QuoteTransfer;
use SprykerShop\Yves\CartPage\Model\CartItemReader as SprykerShopCartItemReader;

class CartItemReader extends SprykerShopCartItemReader
{
    /**
     * @var string
     */
    protected $locale;

    /**
     * @var \FondOfSpryker\Yves\CartPage\Dependency\Plugin\CartItemTransformerPluginInterface[]
     */
    protected $cartItemTransformerPlugins;

    /**
     * @param array $cartItemTransformerPlugins
     * @param string $locale
     */
    public function __construct(array $cartItemTransformerPlugins, string $locale)
    {
        parent::__construct($cartItemTransformerPlugins);
        $this->cartItemTransformerPlugins = $cartItemTransformerPlugins;
        $this->locale = $locale;
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\ItemTransfer[]
     */
    public function getCartItems(QuoteTransfer $quoteTransfer): array
    {
        $cartItems = $quoteTransfer->getItems()->getArrayCopy();

        foreach ($this->cartItemTransformerPlugins as $cartItemTransformerPlugin) {
            $cartItems = $cartItemTransformerPlugin->transformCartItems($cartItems, $quoteTransfer, $this->locale);
        }

        return $cartItems;
    }
}
