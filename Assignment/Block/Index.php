<?php

namespace Amila\Assignment\Block;


class Index extends \Magento\Framework\View\Element\Template
{
    protected $formKey;
    /**
     * Construct
     *
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Framework\Data\Form\FormKey $formKey)
    {
        $this->formKey = $formKey;
        parent::__construct($context);
    }

    /**
     * Get form action URL for license data form
     *
     * @return string
     */
    public function getFormAction()
    {

        return '/assignment/save/save';

    }

    /**
     * Get form key which helps to prevent cross-site request forgery
     *
     * @return string
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getFormKey()
    {
        return $this->formKey->getFormKey();
    }
}
