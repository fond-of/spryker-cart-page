# fond-of-spryker/fond-of-spryker/checkout-page
[![license](https://img.shields.io/github/license/mashape/apistatus.svg)](https://packagist.org/packages/fond-of-spryker/cart-page)

## Install

```
composer require fond-of-spryker/cart-page
```

## Extend in PYZ
```
<?php

namespace Pyz\Yves\CartPage;

use FondOfSpryker\Yves\CartPage\CartPageDependencyProvider as FondOfCartPageDependencyProvider;
use FondOfSpryker\Yves\CartPage\Plugin\LocalizedAbstractAttributesExpanderPlugin;
use FondOfSpryker\Yves\CartPage\Plugin\ThumbnailImageExpanderPlugin;

class CartPageDependencyProvider extends FondOfCartPageDependencyProvider
{
    /**
     * @return \FondOfSpryker\Yves\CartPage\Dependency\Plugin\CartItemTransformerPluginInterface[]
     */
    protected function getCartItemTransformerPlugins(): array
    {
        return [
            new LocalizedAbstractAttributesExpanderPlugin(),
            new ThumbnailImageExpanderPlugin(),
        ];
    }
}
```

## Configuration

After item add to cart or item remove from cart redirect to cart or stay on page. Default is true
```
$config[CartPageConstants::REDIRECT_TO_CART_AFTER_ADD_TO_CART] = true|false;
```
