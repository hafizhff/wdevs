<?php
/**
 * @category  Wdevs
 * @package   Wdevs_CustomBar
 * @author    Hafizh FF <hafizhff@gmail.com>
 * @copyright 2022 © Magento All rights reserved.
 */
namespace Wdevs\CustomBar\Model;

use Magento\Framework\Model\AbstractModel;

/**
 * Class WdevsCustombar
 * @package Wdevs\CustomBar\Model
 */
class WdevsCustombar extends AbstractModel
{
    /**
     * Initialize customer phone resource model
     * @SuppressWarnings(PHPMD.CamelCaseMethodName)
     */
    public function _construct()
    {
        $this->_init('Wdevs\CustomBar\Model\ResourceModel\WdevsCustombar');
    }
}
