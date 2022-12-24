<?php
/**
 * @category  Wdevs
 * @package   Wdevs_CustomBar
 * @author    Hafizh FF <hafizhff@gmail.com>
 * @copyright 2022 © Magento All rights reserved.
 */

namespace Wdevs\CustomBar\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Config\Model\ResourceModel\Config\Data\CollectionFactory as ConfigCollection;

/**
 * Class Data
 * @package Wdevs\CustomBar\Helper
 */
class Data extends AbstractHelper
{
    /**
     * @var ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * @var ConfigCollection
     */
    protected $configCollection;

    /**
     * Constructor.
     * 
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        ScopeConfigInterface $scopeConfig,
        ConfigCollection $configCollection
    ) {
        $this->scopeConfig = $scopeConfig;
        $this->configCollection = $configCollection;
    }

    /**
     * Get status of the module
     *
     * @return void
     */
    public function getStatusModuleValue()
    {
        $collection = $this->configCollection->create();
        $collection->addFieldToFilter("path",['eq'=>"customBar/general/enabled"]);
        if ($collection->getSize() > 0 ) {
            return $collection->getFirstItem()->getData()['value'];
        } else {
            return false;
        }

    }
}