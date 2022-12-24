<?php
/**
 * @category  Wdevs
 * @package   Wdevs_CustomBar
 * @author    Hafizh FF <hafizhff@gmail.com>
 * @copyright 2022 © Magento All rights reserved.
 */

namespace Wdevs\CustomBar\Controller\Adminhtml;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Registry;

/**
 * Class TopBar
 * @package Wdevs\CustomBar\Controller\Adminhtml
 */
abstract class TopBar extends Action
{
    /**
     * @var Registry
     */
    protected $coreRegistry;

    /**
     * Admin resource
     */
    const ADMIN_RESOURCE = 'Wdevs_CustomBar::custombar';

    /**
     * Constructor
     * 
     * @param Context $context
     * @param Registry $coreRegistry
     */
    public function __construct(
        Context $context,
        Registry $coreRegistry
    ) {
        $this->coreRegistry = $coreRegistry;
        parent::__construct($context);
    }

    /**
     * Init page
     *
     * @param \Magento\Backend\Model\View\Result\Page $resultPage
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function initPage($resultPage)
    {
        $resultPage->setActiveMenu('Magento_Backend::content')
            ->addBreadcrumb(__('Wdevs Module'), __('Top Bar Content'))
            ->addBreadcrumb(__('Wdevs Module'), __('Top Bar Content'));
        return $resultPage;
    }
}
