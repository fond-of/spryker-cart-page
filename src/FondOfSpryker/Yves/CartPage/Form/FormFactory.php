<?php

namespace FondOfSpryker\Yves\CartPage\Form;

use SprykerShop\Yves\CartPage\Form\FormFactory as SprykerShopFormFactory;
use Symfony\Component\Form\FormInterface;

class FormFactory extends SprykerShopFormFactory
{
    /**
     * @param string $prefix
     *
     * @return \Symfony\Component\Form\FormInterface
     */
    public function getRemoveFormWithData(string $prefix): FormInterface
    {
        $data = ['prefix' => $prefix];

        return $this->getFormFactory()->create(RemoveForm::class);
    }
}
