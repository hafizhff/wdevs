<?php
/**
 * @category  Wdevs
 * @package   Wdevs_CustomBar
 * @author    Hafizh FF <hafizhff@gmail.com>
 * @copyright 2022 © Magento All rights reserved.
 */
namespace Wdevs\CustomBar\Controller\TopBar;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Wdevs\CustomBar\Model\ResourceModel\WdevsCustombar\CollectionFactory;
use Magento\Framework\App\Http\Context as HttpContext;
use Wdevs\CustomBar\Helper\Data as Helper;
use Magento\Cms\Model\Template\FilterProvider;
use Magento\Customer\Model\Context as CustomerContext;

class GetConfig extends Action
{
    const STATUS_SUCCESS = 'success';

    /**
     * @var CollectionFactory
     */
    protected $collectionFactory;

    /**
     * @var HttpContext
     */
    protected $httpContext;

    /**
     * @var Helper
     */
    protected $helper;

    /**
     * @var FilterProvider
     */
    protected $filter;

    /**
     * Constructor
     *
     * @param Context $context
     * @param CollectionFactory $collectionFactory
     * @param HttpContext $httpContext
     * @param Helper $helper
     * @param FilterProvider $filter
     */
    public function __construct(
        Context $context,
        CollectionFactory $collectionFactory,
        HttpContext $httpContext,
        Helper $helper,
        FilterProvider $filter
    ) {
        $this->collectionFactory = $collectionFactory;
        $this->httpContext = $httpContext;
        $this->helper = $helper;
        $this->filter = $filter;
        parent::__construct($context);
    }

    /**
     * Get Data from database
     *
     * @return void
     */
    public function execute()
    {
        $isAjax = $this->getRequest()->getParam('isAjax');

        if ($isAjax) {
            
            try {
                $response = [
                    'status' => self::STATUS_SUCCESS,
                    'enable' => $this->isModuleEnabled(),
                    'content' => $this->getContent(),
                ];
    
                $resultJson = $this->resultFactory->create(ResultFactory::TYPE_JSON);
                $resultJson->setData($response);
    
                return $resultJson;
            } catch (\Exception $e) {
                return $e->getMessage();
            }
        } else {
            echo "this request only allowed for ajax call";
        }
        
    }

    /**
     * Get content from database based customer group
     *
     * @return string
     */
    public function getContent()
    {
        $customerGroupId = $this->getCustomerGroupId();
        $collection = $this->collectionFactory->create();
        $collection->checkByCustomerGroupIds($customerGroupId);
        
        if ($collection->getSize() > 0)
        {
            return $this->filter->getBlockFilter()->filter($collection->getFirstItem()->getContent());
        }
        
        return '';
    }

    /**
     * Get customer group id
     *
     * @return string
     */
    private function getCustomerGroupId()
    {
        return $this->httpContext->getValue(CustomerContext::CONTEXT_GROUP);
    }

    /**
     * Get config value
     *
     * @return boolean
     */
    private function isModuleEnabled()
    {
        return $this->helper->getStatusModuleValue();
    }
}