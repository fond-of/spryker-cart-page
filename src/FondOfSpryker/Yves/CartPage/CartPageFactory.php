<?php

namespace FondOfSpryker\Yves\CartPage;

use FondOfSpryker\Yves\CartPage\Dependency\Client\CartPageToProductImageStorageClientInterface;
use FondOfSpryker\Yves\CartPage\Model\CartItemReader;
use SprykerShop\Yves\CartPage\CartPageFactory as SprykerShopCartPageFactory;

/**
 * @method \FondOfSpryker\Yves\CartPage\CartPageConfig getConfig()
 */
class CartPageFactory extends SprykerShopCartPageFactory
{
    /**
     * @param string $locale
     *
     * @return \FondOfSpryker\Yves\CartPage\Model\CartItemReader
     */
    public function createCartItemReaderWithLocale(string $locale)
    {
        return new CartItemReader($this->getCartItemTransformerPlugins(), $locale);
    }

    /**
     * @return \FondOfSpryker\Yves\CartPage\Dependency\Client\CartPageToProductImageStorageClientInterface
     */
    public function getProductImageStorageClient(): CartPageToProductImageStorageClientInterface
    {
        return $this->getProvidedDependency(CartPageDependencyProvider::CLIENT_PRODUCT_IMAGE_STORAGE);
    }

    /**
     * @return array<\FondOfSpryker\Yves\CartPage\Dependency\Plugin\CartItemTransformerPluginInterface>
     */
    public function getCartItemTransformerPlugins()
    {
        return $this->getProvidedDependency(CartPageDependencyProvider::PLUGIN_CART_ITEM_TRANSFORMERS);
    }
}
