<?php

namespace FondOfSpryker\Yves\CartPage;

use FondOfSpryker\Shared\CartPages\CartPageConstants;
use Spryker\Yves\Kernel\AbstractBundleConfig;

class CartPageConfig extends AbstractBundleConfig
{
    /**
     * @return bool
     */
    public function getShouldRedirectToCartAfterAddToCart(): bool
    {
        return $this->get(CartPageConstants::REDIRECT_TO_CART_AFTER_ADD_TO_CART, true);
    }
}
