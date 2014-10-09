<?php
namespace UrlRewrite;

class Module
{
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    // Service Manager Configuration
    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'UrlRewrite\Service\UrlRewriteService' => 'UrlRewrite\Service\UrlRewriteServiceFactory',
            ),
        );
    }


    // Controller Configuration
    public function getControllerConfig()
    {
        return array(
            'factories' => array(
                'UrlRewrite\Controller\Redirect' => 'UrlRewrite\Controller\RedirectControllerFactory',
            )
        );
    }
}
