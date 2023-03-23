<?php

namespace FondOfSpryker\Yves\CartPage;

use FondOfSpryker\Shared\CartPage\CartPageConstants;
use SprykerShop\Yves\CartPage\CartPageConfig as SprykerCartPageConfig;

class CartPageConfig extends SprykerCartPageConfig
{
    /**
     * @return bool
     */
    public function getShouldRedirectToCartAfterAddToCart(): bool
    {
        return $this->get(CartPageConstants::REDIRECT_TO_CART_AFTER_ADD_TO_CART, true);
    }
}
