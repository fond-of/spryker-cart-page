<?php

namespace FondOfSpryker\Yves\CartPage\Controller;

use FondOfSpryker\Yves\CartPage\Plugin\Router\CartPageRouteProviderPlugin;
use Spryker\Shared\Kernel\Store;
use Spryker\Yves\Kernel\View\View;
use SprykerShop\Yves\CartPage\Controller\CartController as SprykerShopCartController;
use SprykerShop\Yves\CartPage\Plugin\Provider\CartControllerProvider;
use Symfony\Component\HttpFoundation\Request;

/**
 * @method \FondOfSpryker\Yves\CartPage\CartPageFactory getFactory()
 */
class CartController extends SprykerShopCartController
{
    public const REQUEST_HEADER_REFERER = 'referer';

    /**
     * @param array $selectedAttributes
     *
     * @return array
     */
    protected function executeIndexAction(array $selectedAttributes = []): array
    {
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

        return [
            'removeCartItemForm' => $this->getFactory()->createCartPageFormFactory()->getRemoveForm()->createView(),
            'cart' => $quoteTransfer,
            'isQuoteEditable' => $quoteClient->isQuoteEditable($quoteTransfer),
            'isQuoteLocked' => $quoteClient->isQuoteLocked($quoteTransfer),
            'cartItems' => $cartItems,
            'attributes' => $itemAttributesBySku,
            'isQuoteValid' => $validateQuoteResponseTransfer->getIsSuccessful(),
        ];
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Spryker\Yves\Kernel\View\View
     */
    public function addInfoAction(Request $request): View
    {
        $productData = $this->getFactory()->getProductAliasStorageClient()->getProductConcreteStorageDataBySku($request->attributes->get('sku'), Store::getInstance()->getCurrentLocale());

        return $this->view(
            [
                'product' => $productData,
            ],
            [],
            '@CartPage/views/info/cart-add-info.twig'
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
        if ($this->getFactory()->getShouldRedirectToCartAfterAddToCart() === false) {
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

        if ($this->getFactory()->getShouldRedirectToCartAfterAddToCart() === false) {
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

        return $this->redirectResponseInternal(CartControllerProvider::ROUTE_CART);
    }
}
