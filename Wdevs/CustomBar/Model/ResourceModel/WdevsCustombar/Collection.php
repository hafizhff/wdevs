<?php
/**
 * @category  Wdevs
 * @package   Wdevs_CustomBar
 * @author    Hafizh FF <hafizhff@gmail.com>
 * @copyright 2022 © Magento All rights reserved.
 */

namespace Wdevs\CustomBar\Model\ResourceModel\WdevsCustombar;

/**
 * Class Collection
 * @package Wdevs\CustomBar\Model\ResourceModel\WdevsCustombar
 */
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = 'id';

    /**
     * Initialize model and resource model
     * @SuppressWarnings(PHPMD.CamelCaseMethodName)
     */
    public function _construct()
    {
        $this->_init(
            'Wdevs\CustomBar\Model\WdevsCustombar',
            'Wdevs\CustomBar\Model\ResourceModel\WdevsCustombar'
        );
        $this->_map['fields']['id'] = 'main_table.id';
    }

    /**
     * Get Query Result by Customer Group
     *
     * @param string $customerGroupIds
     * @return object
     */
    public function checkByCustomerGroupIds($customerGroupIds)
    {
        $customerGroupFilter = '';
        $customerGroup = explode(',', $customerGroupIds);
        $countArray = count($customerGroup);
        for ($idx = 0; $idx < $countArray; $idx++) {
            $orFilter = $idx < $countArray - 1 ? " or " : "";
            $customerGroupFilter .= "FIND_IN_SET(".$customerGroup[$idx].", customer_group) > 0 ".$orFilter;
        }

        return $this->getSelect()->Where($customerGroupFilter); 
    }
    
}
