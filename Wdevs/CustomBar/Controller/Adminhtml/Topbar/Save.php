<?php
/**
 * @category  Wdevs
 * @package   Wdevs_CustomBar
 * @author    Hafizh FF <hafizhff@gmail.com>
 * @copyright 2022 © Magento All rights reserved.
 */
namespace Wdevs\CustomBar\Controller\Adminhtml\TopBar;

use Wdevs\CustomBar\Controller\Adminhtml\TopBar as BaseController;
use Wdevs\CustomBar\Model\WdevsCustombarFactory;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Registry;

/**
 * Class Save
 * @package Wdevs\CustomBar\Controller\Adminhtml\TopBar
 */
class Save extends BaseController
{
    /**
     * @var WdevsCustombarFactory
     */
    protected $modelFactory;

    /**
     * @var WdevsCustombarFactory
     */
    protected $checkCollection;

     /**
      * Constructor
      *
      * @param Context $context
      * @param Registry $coreRegistry
      * @param WdevsCustombarFactory $modelFactory
      */
    public function __construct(
        Context $context,
        Registry $coreRegistry,
        WdevsCustombarFactory $modelFactory
    ) {
        $this->modelFactory = $modelFactory;
        parent::__construct($context, $coreRegistry);
    }

    /**
     * Save action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     * @SuppressWarnings(PHPMD.ShortVariable)
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();
        if ($data) {
            $id = $this->getRequest()->getParam('id');
            $model = $this->modelFactory->create();
            $this->checkCollection = $model->getCollection();

            if ($id) {
                $model->load($id);
                $this->checkCollection->addFieldToFilter('id', ['neq' => $this->getRequest()->getParam('id')]);
            } 

            $tmpCollection = clone $this->checkCollection;
            $tmpCollection->addFieldToFilter('title', $data['title']);
            
            if ($tmpCollection->getSize() > 0) {
                $this->messageManager->addWarningMessage(__('The Title Name already Exists'));
                return $resultRedirect->setPath('*/*/');
            }

            $customerGroupFilter = '';
            $customerGroup = $data['customer_group'];
            $countArray = count($customerGroup);
            for ($idx = 0; $idx < $countArray; $idx++) {
                $orFilter = $idx < $countArray - 1 ? " or " : "";
                $customerGroupFilter .= "FIND_IN_SET(".$customerGroup[$idx].", customer_group) > 0 ".$orFilter;
            }

            if ($customerGroupFilter != '') {    
                $tmpCollection->getSelect()->reset(\Magento\Framework\DB\Select::WHERE);
                $tmpCollection->addFieldToFilter('id', ['neq' => $this->getRequest()->getParam('id')]);
                $tmpCollection->getSelect()->Where($customerGroupFilter); 
                if (count($tmpCollection->getData()) > 0) {
                    $this->messageManager->addWarningMessage(__('There is Customer Group already Assigned to other Top Bar '));
                    return $resultRedirect->setPath('*/*/');
                }
            }

            $modelData = array(
                'title' => $data['title'],
                'customer_group' => implode(',', $customerGroup),
                'content' => $data['content']
            );  

            /** End Check Parameter */
            try {
                
                $model->addData($modelData);
                $model->save();
                $this->messageManager->addSuccessMessage(__('Successfully saved custom bar '));

               
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['id' => $model->getId()]);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage($e, 
                    $e->getMessage()
                );
            }
            return $resultRedirect->setPath('*/*/edit', ['id' => $this->getRequest()->getParam('id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }

}