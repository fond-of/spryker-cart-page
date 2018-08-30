<?php

namespace FondOfSpryker\Yves\CartPage;

use FondOfSpryker\Client\ProductImageStorage\Plugin\ProductViewImageExpanderPlugin;
use FondOfSpryker\Yves\DiscountWidget\Plugin\CartPage\DiscountVoucherFormWidgetPlugin;
use FondOfSpryker\Yves\CartPage\Dependency\Client\CartPageToProductImageStorageBridge;
use FondOfSpryker\Yves\CartPage\Plugin\ImageExpanderPlugin;
use FondOfSpryker\Yves\CartPage\Plugin\ThumbnailImageExpanderPlugin;
use Spryker\Yves\Kernel\Container;
use SprykerShop\Yves\CartPage\CartPageDependencyProvider as SprykerCartPageDependencyProvider;
use SprykerShop\Yves\CheckoutWidget\Plugin\CartPage\CheckoutBreadcrumbWidgetPlugin;
use SprykerShop\Yves\DiscountPromotionWidget\Plugin\CartPage\DiscountPromotionItemListWidgetPlugin;
use SprykerShop\Yves\DiscountWidget\Plugin\CartPage\DiscountSummaryWidgetPlugin;
use Spryker\Client\ProductStorageExtension\Dependency\Plugin\ProductViewExpanderPluginInterface;

class CartPageDependencyProvider extends SprykerCartPageDependencyProvider
{
    const PRODUCT_IMAGE_EXPANDER = 'PRODUCT_IMAGE_EXPANDER';
    const PRODUCT_IMAGE_STORAGE_CLIENT = 'PRODUCT_IMAGE_STORAGE_CLIENT';

    /**
     * @param \Spryker\Yves\Kernel\Container $container
     *
     * @return \Spryker\Yves\Kernel\Container
     */
    public function provideDependencies(Container $container)
    {
        $container = $this->addCartClient($container);
        $container = $this->addProductStorageClient($container);
        $container = $this->addAvailabilityClient($container);
        $container = $this->addAvailabilityStorageClient($container);
        $container = $this->addApplication($container);
        $container = $this->addCartVariantAttributeMapperPlugin($container);
        $container = $this->addCartPageWidgetPlugins($container);
        $container = $this->addCartItemTransformerPlugins($container);
        $container = $this->addZedRequestClient($container);
        $container = $this->addProductImageStorageClient($container);

        return $container;
    }

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
            new ThumbnailImageExpanderPlugin()
        ];
    }
}
