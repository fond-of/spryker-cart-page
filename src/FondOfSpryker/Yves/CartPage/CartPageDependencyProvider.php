<?php

namespace FondOfSpryker\Yves\CartPage;

use FondOfSpryker\Client\ProductImageStorage\Plugin\ProductViewImageExpanderPlugin;
use FondOfSpryker\Yves\CartPage\Dependency\Client\CartPageToProductImageStorageBridge;
use FondOfSpryker\Yves\CartPage\Plugin\LocalizedAbstractAttributesExpanderPlugin;
use FondOfSpryker\Yves\CartPage\Plugin\ThumbnailImageExpanderPlugin;
use FondOfSpryker\Yves\DiscountWidget\Plugin\CartPage\DiscountVoucherFormWidgetPlugin;
use Spryker\Client\ProductStorageExtension\Dependency\Plugin\ProductViewExpanderPluginInterface;
use Spryker\Yves\Kernel\Container;
use SprykerShop\Yves\CartPage\CartPageDependencyProvider as SprykerCartPageDependencyProvider;
use SprykerShop\Yves\CheckoutWidget\Plugin\CartPage\CheckoutBreadcrumbWidgetPlugin;
use SprykerShop\Yves\DiscountPromotionWidget\Plugin\CartPage\DiscountPromotionItemListWidgetPlugin;
use SprykerShop\Yves\DiscountWidget\Plugin\CartPage\DiscountSummaryWidgetPlugin;

class CartPageDependencyProvider extends SprykerCartPageDependencyProvider
{
    const PRODUCT_IMAGE_EXPANDER = 'PRODUCT_IMAGE_EXPANDER';
    const PRODUCT_IMAGE_STORAGE_CLIENT = 'PRODUCT_IMAGE_STORAGE_CLIENT';

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
            CheckoutBreadcrumbWidgetPlugin::class,
            DiscountVoucherFormWidgetPlugin::class,
            DiscountSummaryWidgetPlugin::class,
            DiscountPromotionItemListWidgetPlugin::class,
        ];
    }

    protected function getProductViewExpanderPlugin(): ProductViewExpanderPluginInterface
    {
        return new ProductViewImageExpanderPlugin();
    }

    /**
     * @return \FondOfSpryker\Yves\CartPage\Plugin\ThumbnailImageExpanderPluginInterface[]
     */
    protected function getCartItemTransformerPlugins(): array
    {
        return [
            new LocalizedAbstractAttributesExpanderPlugin(),
            new ThumbnailImageExpanderPlugin(),
        ];
    }
}
