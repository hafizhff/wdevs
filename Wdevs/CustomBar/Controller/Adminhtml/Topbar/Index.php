<?php
/**
 * @category  Wdevs
 * @package   Wdevs_CustomBar
 * @author    Hafizh FF <hafizhff@gmail.com>
 * @copyright 2022 © Magento All rights reserved.
 */
namespace Wdevs\CustomBar\Controller\Adminhtml\TopBar;

use Wdevs\CustomBar\Controller\Adminhtml\TopBar as BaseController;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Registry;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Serialize\Serializer\Json as JsonSerializer;

/**
 * Class Index
 * @package Wdevs\CustomBar\Controller\Adminhtml\TopBar
 */
class Index extends BaseController
{
    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * @var JsonSerializer
     */
    protected $jsonSerializer;

    /**
     * Index constructor.
     * @param Context $context
     * @param Registry $coreRegistry
     * @param PageFactory $resultPageFactory
     * @param JsonSerializer $jsonHelper
     */
    public function __construct(
        Context $context,
        Registry $coreRegistry,
        PageFactory $resultPageFactory,
        JsonSerializer $jsonHelper
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->jsonSerializer = $jsonHelper;
        parent::__construct($context, $coreRegistry);
    }

    /**
     * Index action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Magento_Backend::content');
        $resultPage->getConfig()->getTitle()->set(__("Wdevs Top Bar"));
        return $resultPage;
    }

  
}

