<?php

namespace FondOfSpryker\Yves\CartPage\Controller;

use FondOfSpryker\Yves\CartPage\Plugin\Router\CartPageRouteProviderPlugin;
use Spryker\Yves\Kernel\View\View;
use SprykerShop\Yves\CartPage\Controller\CartController as SprykerShopCartController;
use Symfony\Component\HttpFoundation\Request;

/**
 * @method \FondOfSpryker\Yves\CartPage\CartPageFactory getFactory()
 */
class CartController extends SprykerShopCartController
{
    /**
     * @var string
     */
    public const REQUEST_HEADER_REFERER = 'referer';

    /**
     * @param array $selectedAttributes
     * @param bool $withItems
     *
     * @return array<string, mixed>
     */
    protected function executeIndexAction(array $selectedAttributes = [], bool $withItems = true): array
    {
        $viewData = parent::executeIndexAction($selectedAttributes, $withItems);

        $validateQuoteResponseTransfer = $this->getFactory()
            ->getCartClient()
            ->validateQuote();

        $this->getFactory()
            ->getZedRequestClient()
            ->addResponseMessagesToMessenger();

        $quoteTransfer = $validateQuoteResponseTransfer->getQuoteTransfer();

        $cartItems = $this->getFactory()
            ->createCartItemReaderWithLocale($this->getLocale())
            ->getCartItems($quoteTransfer);

        $itemAttributesBySku = $this->getFactory()
            ->createCartItemsAttributeProvider()
            ->getItemsAttributes($quoteTransfer, $this->getLocale(), $selectedAttributes);

        $quoteClient = $this->getFactory()->getQuoteClient();

        return array_merge($viewData, [
            'removeCartItemForm' => $this->getFactory()->createCartPageFormFactory()->getRemoveForm()->createView(),
            'cart' => $quoteTransfer,
            'isQuoteEditable' => $quoteClient->isQuoteEditable($quoteTransfer),
            'isQuoteLocked' => $quoteClient->isQuoteLocked($quoteTransfer),
            'cartItems' => $cartItems,
            'attributes' => $itemAttributesBySku,
            'isQuoteValid' => $validateQuoteResponseTransfer->getIsSuccessful(),
        ]);
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Spryker\Yves\Kernel\View\View
     */
    public function addInfoAction(Request $request): View
    {
        $currentLocale = $this->getFactory()
            ->getLocaleClient()
            ->getCurrentLocale();

        $productData = $this->getFactory()
            ->getProductAliasStorageClient()
            ->getProductConcreteStorageDataBySku($request->attributes->get('sku'), $currentLocale);

        return $this->view(
            [
                'product' => $productData,
            ],
            [],
            '@CartPage/views/info/cart-add-info.twig',
        );
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @param string $sku
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function addAction(Request $request, $sku)
    {
        if ($request->getMethod() === Request::METHOD_GET) {
            return $this->redirectResponseInternal(CartPageRouteProviderPlugin::ROUTE_CART_ADD_INFO, ['sku' => $sku]);
        }

        $redirect = parent::addAction($request, $sku);
        if ($this->getFactory()->getConfig()->getShouldRedirectToCartAfterAddToCart() === false) {
            $redirect = $this->redirect($request);
        }

        return $redirect;
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @param string $sku
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function removeAction(Request $request, $sku)
    {
        $redirect = parent::removeAction($request, $sku);

        if ($this->getFactory()->getConfig()->getShouldRedirectToCartAfterAddToCart() === false) {
            $redirect = $this->redirect($request);
        }

        return $redirect;
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    protected function redirect(Request $request)
    {
        if ($request->headers->has(static::REQUEST_HEADER_REFERER)) {
            return $this->redirectResponseExternal($request->headers->get(static::REQUEST_HEADER_REFERER));
        }

        return $this->redirectResponseInternal(CartPageRouteProviderPlugin::ROUTE_CART_PUBLIC);
    }
}
