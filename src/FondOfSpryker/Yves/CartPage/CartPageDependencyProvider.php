<?php

namespace FondOfSpryker\Yves\CartPage;

use FondOfSpryker\Client\ProductImageStorage\Plugin\ProductViewImageExpanderPlugin;
use FondOfSpryker\Yves\CartPage\Dependency\Client\CartPageToProductImageStorageBridge;
use FondOfSpryker\Yves\CartPage\Dependency\Client\CartPageToProductImageStorageClientBridge;
use Spryker\Client\ProductStorageExtension\Dependency\Plugin\ProductViewExpanderPluginInterface;
use Spryker\Yves\Kernel\Container;
use SprykerShop\Yves\CartPage\CartPageDependencyProvider as SprykerCartPageDependencyProvider;
use SprykerShop\Yves\DiscountPromotionWidget\Plugin\CartPage\DiscountPromotionItemListWidgetPlugin;
use SprykerShop\Yves\DiscountWidget\Plugin\CartPage\DiscountSummaryWidgetPlugin;

class CartPageDependencyProvider extends SprykerCartPageDependencyProvider
{
    /**
     * @var string
     */
    public const CLIENT_PRODUCT_IMAGE_STORAGE = 'CLIENT_PRODUCT_IMAGE_STORAGE';

    /**
     * @var string
     */
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
        $container = $this->addProductImageStorageClient($container);

        return $container;
    }

    /**
     * @param Container $container
     *
     * @return Container
     */
    protected function addProductImageStorageClient(Container $container): Container
    {
        $container[static::CLIENT_PRODUCT_IMAGE_STORAGE] = static function (Container $container) {
            return new CartPageToProductImageStorageClientBridge(
                $container->getLocator()->productImageStorage()->client()
            );
        };

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
     * @return array
     */
    protected function getCartPageWidgetPlugins(): array
    {
        return [
            DiscountSummaryWidgetPlugin::class,
            DiscountPromotionItemListWidgetPlugin::class,
        ];
    }
}
