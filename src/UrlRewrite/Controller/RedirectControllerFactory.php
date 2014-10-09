<?php


namespace UrlRewrite\Controller;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;


class RedirectControllerFactory
    implements FactoryInterface
{

    /**
     * Default method to be used in a Factory Class
     *
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     *
     * @param ServiceLocatorInterface $serviceLocator
     *
     * @return \UrlRewrite\Controller\RedirectController
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        // dependency is fetched from Service Manager
        $urlRewriteService = $serviceLocator->getServiceLocator()->get('UrlRewrite\Service\UrlRewriteService');

        // Controller is constructed, dependencies are injected (IoC in action)
        $controller = new RedirectController($urlRewriteService);

        return $controller;
    }
}
