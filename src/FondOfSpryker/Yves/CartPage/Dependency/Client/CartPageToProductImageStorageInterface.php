<?php

namespace FondOfSpryker\Yves\CartPage\Dependency\Client;

use FondOfSpryker\Client\ProductImageStorage\ProductImageStorageClientInterface;
use Spryker\Client\ProductImageStorage\Storage\ProductAbstractImageStorageReaderInterface;

interface CartPageToProductImageStorageInterface
{
    /**
     * @param \FondOfSpryker\Client\ProductImageStorage\ProductImageStorageClientInterface $productImageStorageClient
     */
    public function __construct(ProductImageStorageClientInterface $productImageStorageClient);

    /**
     * @return \Spryker\Client\ProductImageStorage\Storage\ProductAbstractImageStorageReaderInterface
     */
    public function getProductAbstractImageStorageReader(): ProductAbstractImageStorageReaderInterface;
}
