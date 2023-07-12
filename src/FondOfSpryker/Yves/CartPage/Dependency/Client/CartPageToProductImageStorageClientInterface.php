<?php

namespace FondOfSpryker\Yves\CartPage\Dependency\Client;

use Generated\Shared\Transfer\ProductAbstractImageStorageTransfer;

interface CartPageToProductImageStorageClientInterface
{
    /**
     * @param int $idProductAbstract
     * @param string $locale
     *
     * @return \Generated\Shared\Transfer\ProductAbstractImageStorageTransfer|null
     */
    public function findProductImageAbstractStorageTransfer(
        int $idProductAbstract,
        string $locale
    ): ?ProductAbstractImageStorageTransfer;
}
