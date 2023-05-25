<?php
/**
 * Copyright © Nilesh Dubey All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace NdCode\CustomRouter\Controller\Index;

use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\View\Result\PageFactory;

class Index implements HttpGetActionInterface
{

    /**
     * @var PageFactory
     */
    protected $resultPageFactory;
    /** @var RequestInterface $request */
    private RequestInterface $request;

    /**
     * Constructor
     *
     * @param PageFactory $resultPageFactory
     */
    public function __construct(PageFactory $resultPageFactory, RequestInterface $request)
    {
        $this->resultPageFactory = $resultPageFactory;
        $this->request = $request;
    }

    /**
     * Execute view action
     *
     * @return ResultInterface
     */
    public function execute()
    {
        $dealerName = $this->request->getParam("dealer_name");
        $page = $this->resultPageFactory->create();
        $page->getConfig()->getTitle()->set($dealerName);
        return $page;
    }
}
