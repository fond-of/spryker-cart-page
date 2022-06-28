<?php

namespace FondOfSpryker\Yves\CartPage;

use FondOfSpryker\Client\ProductImageStorage\Plugin\ProductViewImageExpanderPlugin;
use FondOfSpryker\Yves\CartPage\Dependency\Client\CartPageToProductImageStorageBridge;
use Spryker\Client\ProductStorageExtension\Dependency\Plugin\ProductViewExpanderPluginInterface;
use Spryker\Yves\Kernel\Container;
use SprykerShop\Yves\CartPage\CartPageDependencyProvider as SprykerCartPageDependencyProvider;
use SprykerShop\Yves\DiscountPromotionWidget\Plugin\CartPage\DiscountPromotionItemListWidgetPlugin;
use SprykerShop\Yves\DiscountWidget\Plugin\CartPage\DiscountSummaryWidgetPlugin;

class CartPageDependencyProvider extends SprykerCartPageDependencyProvider
{
    public const PRODUCT_IMAGE_EXPANDER = 'PRODUCT_IMAGE_EXPANDER';
    public const PRODUCT_IMAGE_STORAGE_CLIENT = 'PRODUCT_IMAGE_STORAGE_CLIENT';

    protected function addProductImageStorageClient(Container $container): Container
    {
        $container[self::PRODUCT_IMAGE_STORAGE_CLIENT] = function (Container $container) {
            return new CartPageToProductImageStorageBridge($container->getLocator()->productImageStorage()->client());
        };

        return $container;
    }

    /**
     * @return array
     */
    protected function getCartPageWidgetPlugins(): array
    {
        return [
            DiscountSummaryWidgetPlugin::class,
            DiscountPromotionItemListWidgetPlugin::class,
        ];
    }

    /**
     * @return \Spryker\Client\ProductStorageExtension\Dependency\Plugin\ProductViewExpanderPluginInterface
     */
    protected function getProductViewExpanderPlugin(): ProductViewExpanderPluginInterface
    {
        return new ProductViewImageExpanderPlugin();
    }
}
