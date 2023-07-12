<?php

namespace FondOfSpryker\Yves\CartPage\Dependency\Client;

use Generated\Shared\Transfer\ProductAbstractImageStorageTransfer;
use Spryker\Client\ProductImageStorage\ProductImageStorageClientInterface;

class CartPageToProductImageStorageClientBridge implements CartPageToProductImageStorageClientInterface
{
    /**
     * @var \Spryker\Client\ProductImageStorage\ProductImageStorageClientInterface
     */
    protected $productImageStorageClient;

    /**
     * @param \Spryker\Client\ProductImageStorage\ProductImageStorageClientInterface $productImageStorageClient
     */
    public function __construct(ProductImageStorageClientInterface $productImageStorageClient)
    {
        $this->productImageStorageClient = $productImageStorageClient;
    }

    /**
     * @param int $idProductAbstract
     * @param string $locale
     *
     * @return \Generated\Shared\Transfer\ProductAbstractImageStorageTransfer|null
     */
    public function findProductImageAbstractStorageTransfer(
        int $idProductAbstract,
        string $locale
    ): ?ProductAbstractImageStorageTransfer {
        return $this->productImageStorageClient->findProductImageAbstractStorageTransfer($idProductAbstract, $locale);
    }
}
