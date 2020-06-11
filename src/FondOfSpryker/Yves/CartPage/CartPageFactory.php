<?php

namespace FondOfSpryker\Yves\CartPage;

use FondOfSpryker\Yves\CartPage\Model\CartItemReader;
use Spryker\Client\ProductResourceAliasStorage\ProductResourceAliasStorageClientInterface;
use Spryker\Client\Search\SearchClientInterface;
use Spryker\Client\SearchElasticsearch\SearchElasticsearchClientInterface;
use SprykerShop\Yves\CartPage\CartPageFactory as SprykerShopCartPageFactory;

/**
 * @method \FondOfSpryker\Yves\CartPage\CartPageConfig getConfig()
 */
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

    /**
     * @return bool
     */
    public function getShouldRedirectToCartAfterAddToCart(): bool
    {
        return $this->getConfig()->getShouldRedirectToCartAfterAddToCart();
    }

    /**
     * @return \Spryker\Client\ProductResourceAliasStorage\ProductResourceAliasStorageClientInterface
     * @throws \Spryker\Yves\Kernel\Exception\Container\ContainerKeyNotFoundException
     */
    public function getProductAliasStorageClient(): ProductResourceAliasStorageClientInterface
    {
        return $this->getProvidedDependency(CartPageDependencyProvider::CLIENT_PRODUCT_ALIAS_STORAGE);
    }
}
