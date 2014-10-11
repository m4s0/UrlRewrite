<?php
namespace UrlRewrite;

class Module
{
    public function getConfig()
    {
        $files = scandir(__DIR__ . '/config/');
        if (($key = array_search(".", $files)) !== false) {
            unset($files[$key]);
        }
        if (($key = array_search("..", $files)) !== false) {
            unset($files[$key]);
        }

        $config = array();
        foreach ($files as $file) {
            $config = \Zend\Stdlib\ArrayUtils::merge($config, include __DIR__ . '/config/' . $file);
        }

        return $config;
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
}
