<?php

namespace FondOfSpryker\Yves\CartPage;

use FondOfSpryker\Client\ProductImageStorage\Plugin\ProductViewImageExpanderPlugin;
use FondOfSpryker\Yves\CartPage\Dependency\Client\CartPageToProductImageStorageBridge;
use Spryker\Client\ProductStorageExtension\Dependency\Plugin\ProductViewExpanderPluginInterface;
use Spryker\Yves\Kernel\Container;
use SprykerShop\Yves\CartPage\CartPageDependencyProvider as SprykerCartPageDependencyProvider;
use SprykerShop\Yves\CheckoutWidget\Widget\CheckoutBreadcrumbWidget;
use SprykerShop\Yves\DiscountPromotionWidget\Plugin\CartPage\DiscountPromotionItemListWidgetPlugin;
use SprykerShop\Yves\DiscountWidget\Plugin\CartPage\DiscountSummaryWidgetPlugin;

class CartPageDependencyProvider extends SprykerCartPageDependencyProvider
{
    public const PRODUCT_IMAGE_EXPANDER = 'PRODUCT_IMAGE_EXPANDER';
    public const PRODUCT_IMAGE_STORAGE_CLIENT = 'PRODUCT_IMAGE_STORAGE_CLIENT';
    public const CLIENT_PRODUCT_ALIAS_STORAGE = 'CLIENT_PRODUCT_ALIAS_STORAGE';

    /**
     * @param \Spryker\Yves\Kernel\Container $container
     *
     * @return \Spryker\Yves\Kernel\Container
     */
    public function provideDependencies(Container $container)
    {
        $container = parent::provideDependencies($container);
        $container = $this->addProductAliasStorageClient($container);

        return $container;
    }

    /**
     * @param \Spryker\Yves\Kernel\Container $container
     *
     * @return \Spryker\Yves\Kernel\Container
     */
    protected function addProductAliasStorageClient(Container $container): Container
    {
        $container[static::CLIENT_PRODUCT_ALIAS_STORAGE] = function (Container $container) {
            return $container->getLocator()->productResourceAliasStorage()->client();
        };

        return $container;
    }

    /**
     * @param \Spryker\Yves\Kernel\Container $container
     *
     * @return \Spryker\Yves\Kernel\Container
     */
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
            CheckoutBreadcrumbWidget::class,
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
