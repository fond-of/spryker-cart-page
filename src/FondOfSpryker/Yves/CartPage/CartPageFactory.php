<?php

namespace FondOfSpryker\Yves\CartPage;

use FondOfSpryker\Yves\CartPage\Model\CartItemReader;
use SprykerShop\Yves\CartPage\CartPageFactory as SprykerShopCartPageFactory;

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
    
    /**
     * @return \FondOfSpryker\Yves\CartPage\Dependency\Plugin\CartItemTransformerPluginInterface[]
     */
    public function getCartItemTransformerPlugins()
    {
        return $this->getProvidedDependency(CartPageDependencyProvider::PLUGIN_CART_ITEM_TRANSFORMERS);
    }
}
