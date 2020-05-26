<?php

namespace FondOfSpryker\Yves\CartPage\Widget;

use Generated\Shared\Transfer\ItemTransfer;
use Spryker\Yves\Kernel\Widget\AbstractWidget;
use Symfony\Component\Form\FormView;

/**
 * @method \FondOfSpryker\Yves\CartPage\CartPageFactory getFactory()
 */
class RemoveFromCartFormWidget extends AbstractWidget
{
    /**
     * @var \Symfony\Component\Form\FormView|null
     */
    protected static $removeFromCartFromView;

    /**
     * @param array $config
     * @param \Generated\Shared\Transfer\ProductViewTransfer $productViewTransfer
     * @param bool $isRemoveFromCartDisabled
     */
    public function __construct(array $config, ItemTransfer $itemTransfer, bool $isRemoveFromCartDisabled)
    {
        $this->addParameter('removeFromCartForm', $this->getOrCreateRemoveFromCartFormView($itemTransfer->getSku()));
        $this->addParameter('config', $config);
        $this->addParameter('cartItem', $itemTransfer);
        $this->addParameter('isRemoveFromCartDisabled', $isRemoveFromCartDisabled);
    }

    /**
     * @return string
     */
    public static function getName(): string
    {
        return 'RemoveFromCartFormWidget';
    }

    /**
     * @return string
     */
    public static function getTemplate(): string
    {
        return '@CartPage/views/remove-from-cart-form/remove-from-cart-form.twig';
    }

    /**
     * @param string $prefix
     *
     * @return \Symfony\Component\Form\FormView
     */
    protected function createRemoveFromCartFormView(string $prefix): FormView
    {
        return $this->getFactory()
            ->createFondOfCartPageFormFactory()
            ->getRemoveFormWithData($prefix)
            ->createView();
    }

    /**
     * @param string $prefix
     *
     * @return \Symfony\Component\Form\FormView
     */
    protected function getOrCreateRemoveFromCartFormView(string $prefix): FormView
    {
        if (static::$removeFromCartFromView === null) {
            static::$removeFromCartFromView = $this->createRemoveFromCartFormView($prefix);
        }

        return static::$removeFromCartFromView;
    }
}
