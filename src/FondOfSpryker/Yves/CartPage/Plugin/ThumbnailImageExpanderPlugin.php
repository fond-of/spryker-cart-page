<?php

namespace FondOfSpryker\Yves\CartPage\Plugin;

use Generated\Shared\Transfer\ItemTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Spryker\Yves\Kernel\AbstractPlugin;

/**
 * @method \FondOfSpryker\Yves\CartPage\CartPageFactory getFactory()
 */
class ThumbnailImageExpanderPlugin extends AbstractPlugin implements ThumbnailImageExpanderPluginInterface
{
    const THUMBNAIL_IMAGE_SET = 'Thumbnail';

    /**
     * @var \FondOfSpryker\Yves\CartPage\Dependency\Client\CartPageToProductImageStorageInterface
     */
    protected $productImageStorageClient;

    /**
     * @var \Spryker\Client\ProductImageStorage\Storage\ProductAbstractImageStorageReader
     */
    protected $productAbstractImageStorageReader;

    /**
     * ThumbnailImageExpanderPlugin constructor.
     */
    public function __construct()
    {
        $this->productImageStorageClient = $this
            ->getFactory()
            ->getProductImageStorageClient();

        $this->productAbstractImageStorageReader = $this->productImageStorageClient->getProductAbstractImageStorageReader();
    }

    public function transformCartItems(array $cartItems, QuoteTransfer $quoteTransfer, string $locale): array
    {
        /** @var \Generated\Shared\Transfer\ItemTransfer $cartItem */
        foreach ($cartItems as $cartItem) {
            $this->expandItemWithThumnailImageSet($cartItem, $locale);
        }

        return $cartItems;
    }

    /**
     * @return void
     */
    protected function expandItemWithThumnailImageSet(ItemTransfer &$itemTransfer, string $locale)
    {
        $productImageSetStorageTransfer = $this->getAllImageSets(
            $itemTransfer->getIdProductAbstract(),
            $locale
        );

        $itemTransfer->setImages($productImageSetStorageTransfer);
    }

    protected function getAllImageSets(int $idProductAbstract, string $locale): ?\ArrayObject
    {
        $productAbstractImageStorageTransfer = $this->productAbstractImageStorageReader->findProductImageAbstractStorageTransfer(
            $idProductAbstract,
            $locale
        );

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
