<?php

namespace FondOfSpryker\Yves\CartPage;

use FondOfSpryker\Yves\CartPage\Dependency\Client\CartPageToLocaleClientBridge;
use FondOfSpryker\Yves\CartPage\Dependency\Client\CartPageToProductImageStorageClientBridge;
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
     * @var string
     */
    public const CLIENT_LOCALE = 'CLIENT_LOCALE';

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
        $container = $this->addLocaleClient($container);

        return $container;
    }

    /**
     * @param \Spryker\Yves\Kernel\Container $container
     *
     * @return \Spryker\Yves\Kernel\Container
     */
    protected function addProductImageStorageClient(Container $container): Container
    {
        $container[static::CLIENT_PRODUCT_IMAGE_STORAGE] = static function (Container $container) {
            return new CartPageToProductImageStorageClientBridge(
                $container->getLocator()->productImageStorage()->client(),
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
     * @param \Spryker\Yves\Kernel\Container $container
     *
     * @return \Spryker\Yves\Kernel\Container
     */
    protected function addLocaleClient(Container $container): Container
    {
        $container[static::CLIENT_LOCALE] = function (Container $container) {
            return new CartPageToLocaleClientBridge($container->getLocator()->locale()->client());
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
