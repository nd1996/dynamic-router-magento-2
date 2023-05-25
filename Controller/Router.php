<?php
/**
 * Copyright © Nilesh Dubey All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace NdCode\CustomRouter\Controller;

use Magento\Framework\App\ActionFactory;
use Magento\Framework\App\Action\Forward;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\RouterInterface;

class Router implements RouterInterface
{

    protected $transportBuilder;
    protected $actionFactory;

    /**
     * Router constructor
     *
     * @param ActionFactory $actionFactory
     */
    public function __construct(ActionFactory $actionFactory)
    {
        $this->actionFactory = $actionFactory;
    }

    /**
     * {@inheritdoc}
     */
    public function match(RequestInterface $request)
    {
        $result = null;

        if ($request->getModuleName() != 'dealer' && $this->validateRoute($request)) {
            $request->setModuleName('dealer')
                ->setControllerName('index')
                ->setActionName('index')
                ->setParam('dealer_name', $this->getDealerName($request));
            $result = $this->actionFactory->create(Forward::class);
        }
        return $result;
    }

    /**
     * @param RequestInterface $request
     * @return bool
     */
    public function validateRoute(RequestInterface $request)
    {
        $identifier = trim($request->getPathInfo(), '/');
        return str_contains($identifier, 'dealer');
    }

    /**
     * @param RequestInterface $request
     * @return string
     */
    public function getDealerName(RequestInterface $request)
    {
        if (is_null($request)) {
            return "";
        }
        $identifier = trim($request->getPathInfo(), '/');
        $identifierArray = explode("/", $identifier);
        return $identifierArray[1] ?? "";
    }
}

