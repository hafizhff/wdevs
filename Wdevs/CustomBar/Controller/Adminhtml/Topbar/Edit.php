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
 * Class Edit
 * @package Wdevs\CustomBar\Controller\Adminhtml\TopBar
 */
class Edit extends BaseController
{
    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * @var WdevsCustombarFactory
     */
    protected $modelFactory;

    /**
     * Edit constructor.
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
     * Edit action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     * @SuppressWarnings(PHPMD.ShortVariable)
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        $model = $this->modelFactory->create();
        if ($id) {
            $model->load($id);
            if (!$model->getId()) {
                $this->messageManager->addErrorMessage(__('This top bar no longer exists.'));
                $resultRedirect = $this->resultRedirectFactory->create();
                return $resultRedirect->setPath('*/*/');
            }
        }
        $this->coreRegistry->register('wdevstopbar', $model);
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Magento_Backend::content');
        $this->initPage($resultPage)->addBreadcrumb(
            $id ? __('Edit Top Bar') : __('Edit Top Bar'),
            $id ? __('Edit Top Bar') : __('Edit Top Bar')
        );

        $resultPage->getConfig()->getTitle()->prepend(__('Top Bar'));
        $resultPage->getConfig()->getTitle()->prepend($model->getId() ? 'Edit Top Bar ' : __('New Top Bar'));
        return $resultPage;
    }
}
