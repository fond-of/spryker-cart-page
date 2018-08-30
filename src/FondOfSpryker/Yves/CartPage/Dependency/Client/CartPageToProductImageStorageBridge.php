<?php

namespace FondOfSpryker\Yves\CartPage\Dependency\Client;

use FondOfSpryker\Client\ProductImageStorage\ProductImageStorageClientInterface;
use Spryker\Client\ProductImageStorage\Storage\ProductAbstractImageStorageReaderInterface;

class CartPageToProductImageStorageBridge implements CartPageToProductImageStorageInterface
{
    /**
     * @var \Spryker\Client\ProductImageStorage\ProductImageStorageClientInterface
     */
    protected $productImageStorageClient;

    /**
     * CartPageToProductImageStorageBridge constructor.
     *
     * @param \FondOfSpryker\Client\ProductImageStorage\ProductImageStorageClientInterface $productImageStorageClient
     */
    public function __construct(ProductImageStorageClientInterface $productImageStorageClient)
    {
        $this->productImageStorageClient = $productImageStorageClient;
    }

    public function getProductAbstractImageStorageReader(): ProductAbstractImageStorageReaderInterface
    {
        return $this->productImageStorageClient->getProductAbstractImageStorageReader();
    }
}
