<?php

namespace FondOfSpryker\Yves\CartPage\Dependency\Client;


use FondOfSpryker\Client\ProductImageStorage\ProductImageStorageClientInterface;
use Spryker\Client\ProductImageStorage\Storage\ProductAbstractImageStorageReaderInterface;

interface CartPageToProductImageStorageInterface
{
    public function __construct(ProductImageStorageClientInterface $productImageStorageClient);

    public function getProductAbstractImageStorageReader(): ProductAbstractImageStorageReaderInterface;
}