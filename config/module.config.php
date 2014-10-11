<?php

namespace UrlRewrite;

return array(

    //    'service_manager' => array(
    //                'factories'          => array(
    //                    'Router' => 'UrlRewrite\Service\RouterFactory',
    //                ),
    //    ),
    'route_manager' => array(
        'factories' => array(
            'Router' => 'UrlRewrite\Service\RouterFactory'
        ),
    ),
);
