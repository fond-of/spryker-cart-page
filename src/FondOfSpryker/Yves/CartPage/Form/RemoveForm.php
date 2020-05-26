<?php

namespace FondOfSpryker\Yves\CartPage\Form;

use Spryker\Yves\Kernel\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * @method \FondOfSpryker\Yves\CartPage\CartPageConfig getConfig()
 */
class RemoveForm extends AbstractType
{
    public const FORM_NAME = 'removeCartItemForm';

    /**
     * @return string
     */
    public function getBlockPrefix()
    {
        return static::FORM_NAME . md5(time() . rand(1, 999));
    }

    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     * @param array $options
     *
     * @return void
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
    }
}
