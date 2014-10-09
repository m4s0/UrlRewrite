<?php

namespace UrlRewrite;

return array(
    'router'          => array(
        'routes' => array(
            'custom' => array(
                'type'    => 'UrlRewrite\Router\Custom',
                'options' => array(
                    'regex'    => '^/(?!admin?)(?<path>.*)',
                    //                    'regex' => '^/(?!admin?/)(?<path>.*)',
                    'defaults' => array(
                        '__NAMESPACE__' => __NAMESPACE__ . 'Controller',
                        'controller'    => 'redirect',
                        'action'        => 'redirect',
                    ),
                    'spec'     => '/%path%',
                ),
            ),
        ),
    ),
    'route_manager'   => array(
        'factories' => array(
            'Router' => 'UrlRewrite\Service\RouterFactory'
        ),
    ),
    'doctrine'        => array(
        'driver' => array(
            // defines an annotation driver with two paths, and names it `my_annotation_driver`
            __NAMESPACE__ . '_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(__DIR__ . '/../src/' . __NAMESPACE__ . '/Entity')
            ),
            // default metadata driver, aggregates all other drivers into a single one.
            // Override `orm_default` only if you know what you're doing
            'orm_default'             => array(
                'drivers' => array(
                    __NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver'
                )
            ),
        ),
    ),
);
