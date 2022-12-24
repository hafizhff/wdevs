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
use Wdevs\CustomBar\Model\WdevsCustombarFactory;

/**
 * Class Delete
 * @package Wdevs\CustomBar\Controller\Adminhtml\TopBar
 */
class Delete extends BaseController
{
    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * @var MappingFactory
     */
    protected $modelFactory;

    /**
     * Delete constructor.
     * @param Context $context
     * @param Registry $coreRegistry
     * @param PageFactory $resultPageFactory
     * @param WdevsCustombarFactory $modelFactory
     */
    public function __construct(
        Context $context,
        Registry $coreRegistry,
        PageFactory $resultPageFactory,
        WdevsCustombarFactory $modelFactory
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->modelFactory = $modelFactory;
        parent::__construct($context, $coreRegistry);
    }

    /**
     * Delete action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     * @SuppressWarnings(PHPMD.ShortVariable)
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();

        $id = $this->getRequest()->getParam('id');
        if ($id) {
            try {
                $model = $this->modelFactory->create();
                $model->load($id);
                $model->delete();
                $this->messageManager->addSuccessMessage(__('You deleted custom bar'));
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
                return $resultRedirect->setPath('*/*/edit', ['id' => $id]);
            }
        }
        $this->messageManager->addErrorMessage(__('We can\'t find a custom bar to delete.'));
        return $resultRedirect->setPath('*/*/');
    }
}
