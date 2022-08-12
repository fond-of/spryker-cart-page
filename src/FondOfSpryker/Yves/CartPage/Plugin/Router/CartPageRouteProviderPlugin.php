<?php

namespace FondOfSpryker\Yves\CartPage\Plugin\Router;

use Spryker\Yves\Router\Route\RouteCollection;
use SprykerShop\Yves\CartPage\Plugin\Router\CartPageRouteProviderPlugin as SprykerCartPageRouteProviderPlugin;
use Symfony\Component\HttpFoundation\Request;

class CartPageRouteProviderPlugin extends SprykerCartPageRouteProviderPlugin
{
    public const ROUTE_CART_ADD_INFO = 'cart/add-info';
    public const ROUTE_CART_PUBLIC = 'cart';

    /**
     * Specification:
     * - Adds Routes to the RouteCollection.
     *
     * @api
     *
     * @param \Spryker\Yves\Router\Route\RouteCollection $routeCollection
     *
     * @return \Spryker\Yves\Router\Route\RouteCollection
     */
    public function addRoutes(RouteCollection $routeCollection): RouteCollection
    {
        $routeCollection = parent::addRoutes($routeCollection);
        $routeCollection = $this->addCartAddRoute($routeCollection);
        $routeCollection = $this->addCartInfoRoute($routeCollection);

        return $routeCollection;
    }

    /**
     * @param \Spryker\Yves\Router\Route\RouteCollection $routeCollection
     *
     * @return \Spryker\Yves\Router\Route\RouteCollection
     */
    protected function addCartAddRoute(RouteCollection $routeCollection): RouteCollection
    {
        $route = $this->buildRoute('/cart/add/{sku}', 'CartPage', 'Cart', 'addAction');
        $route = $route->setRequirement('sku', static::SKU_PATTERN);
        $route = $route->setMethods([Request::METHOD_POST, Request::METHOD_GET]);
        $routeCollection->add(static::ROUTE_CART_ADD, $route);

        return $routeCollection;
    }

    /**
     * @param \Spryker\Yves\Router\Route\RouteCollection $routeCollection
     *
     * @return \Spryker\Yves\Router\Route\RouteCollection
     */
    protected function addCartInfoRoute(RouteCollection $routeCollection): RouteCollection
    {
        $route = $this->buildRoute('/cart/add-info/{sku}', 'CartPage', 'Cart', 'addInfoAction');
        $route = $route->setRequirement('sku', static::SKU_PATTERN);
        $route = $route->setMethods([Request::METHOD_GET]);
        $routeCollection->add(static::ROUTE_CART_ADD_INFO, $route);

        return $routeCollection;
    }
}
