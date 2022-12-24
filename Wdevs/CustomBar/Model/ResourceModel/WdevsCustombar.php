<?php
/**
 * @category  Wdevs
 * @package   Wdevs_CustomBar
 * @author    Hafizh FF <hafizhff@gmail.com>
 * @copyright 2022 © Magento All rights reserved.
 */

namespace Wdevs\CustomBar\Model\ResourceModel;

/**
 * Class WdevsCustombar
 * @package Wdevs\CustomBar\Model\ResourceModel
 */
class WdevsCustombar extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * Resource initialization
     *
     * @return void
     * @SuppressWarnings(PHPMD.CamelCaseMethodName)
     */
    protected function _construct()
    {
        $this->_init('wdevs_custombar', 'id');
    }
}
