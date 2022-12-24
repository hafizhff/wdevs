<?php
/**
 * @category  Wdevs
 * @package   Wdevs_CustomBar
 * @author    Hafizh FF <hafizhff@gmail.com>
 * @copyright 2022 © Magento All rights reserved.
 */
namespace Wdevs\CustomBar\Block\Adminhtml\TopBar\Edit;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

/**
 * Class SaveAndContinueButton
 * @package Wdevs\CustomBar\Block\Adminhtml\TopBar\Edit
 */
class SaveAndContinueButton extends GenericButton implements ButtonProviderInterface
{
    /**
     * Retrieve button-specified settings
     *
     * @return array
     */
    public function getButtonData()
    {
        if ($this->context->getRequest()->getParam('view')) {
            return false;
        }

        return [
            'label' => __('Save and Continue Edit'),
            'class' => 'save',
            'data_attribute' => [
                'mage-init' => [
                    'button' => ['event' => 'saveAndContinueEdit'],
                ],
            ],
            'sort_order' => 70,
        ];
    }
}
