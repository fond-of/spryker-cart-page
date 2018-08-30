<?php

namespace FondOfSpryker\Yves\CartPage;

use SprykerShop\Yves\CartPage\CartPageFactory as SprykerShopCartPageFactory;
use FondOfSpryker\Yves\CartPage\Model\CartItemReader;

class CartPageFactory extends SprykerShopCartPageFactory
{
    public function createCartItemReaderWithLocale(string $locale)
    {
        return new CartItemReader($this->getCartItemTransformerPlugins(), $locale);
    }

    /**
     * @return mixed
     */
    public function getProductImageStorageClient()
    {
        return $this->getProvidedDependency(CartPageDependencyProvider::PRODUCT_IMAGE_STORAGE_CLIENT);
    }
}
