<?php

namespace FondOfSpryker\Yves\CartPage\Plugin;

use ArrayObject;
use Generated\Shared\Transfer\ItemTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Spryker\Yves\Kernel\AbstractPlugin;
use SprykerShop\Yves\CartPage\Dependency\Plugin\CartItemTransformerPluginInterface;

/**
 * @method \FondOfSpryker\Yves\CartPage\CartPageFactory getFactory()
 */
class ThumbnailImageExpanderPlugin extends AbstractPlugin implements CartItemTransformerPluginInterface
{
    /**
     * @var string
     */
    public const THUMBNAIL_IMAGE_SET = 'Thumbnail';

    /**
     * @param array $cartItems
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return array<\Generated\Shared\Transfer\ItemTransfer>
     */
    public function transformCartItems(array $cartItems, QuoteTransfer $quoteTransfer): array
    {
        /** @var \Generated\Shared\Transfer\ItemTransfer $cartItem */
        foreach ($cartItems as $cartItem) {
            $this->expandItemWithThumnailImageSet($cartItem, $this->getLocale());
        }

        return $cartItems;
    }

    /**
     * @param \Generated\Shared\Transfer\ItemTransfer $itemTransfer
     * @param string $locale
     *
     * @return void
     */
    protected function expandItemWithThumnailImageSet(ItemTransfer &$itemTransfer, string $locale): void
    {
        $productImageSetStorageTransfer = $this->getAllImageSets(
            $itemTransfer->getIdProductAbstract(),
            $locale,
        );

        if ($productImageSetStorageTransfer === null) {
            return;
        }

        $itemTransfer->setImages($productImageSetStorageTransfer);
    }

    /**
     * @param int $idProductAbstract
     * @param string $locale
     *
     * @return \ArrayObject|null
     */
    protected function getAllImageSets(int $idProductAbstract, string $locale): ?ArrayObject
    {
        $productAbstractImageStorageTransfer = $this->getFactory()
            ->getProductImageStorageClient()
            ->findProductImageAbstractStorageTransfer($idProductAbstract, $locale);

        /** @var \Generated\Shared\Transfer\ProductImageSetStorageTransfer $item */
        foreach ($productAbstractImageStorageTransfer->getImageSets() as $item) {
            if ($item->getName() != self::THUMBNAIL_IMAGE_SET) {
                continue;
            }

            return $item->getImages();
        }

        return null;
    }
}
