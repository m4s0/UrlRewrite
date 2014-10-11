<?php


namespace UrlRewrite\Router;

use Zend\Mvc\Router\Http\RouteInterface;
use Zend\Mvc\Router\Http\RouteMatch;
use Zend\Stdlib\RequestInterface as Request;
use Zend\Stdlib\ArrayUtils;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;


class Custom
    implements RouteInterface, ServiceLocatorAwareInterface
{
    protected $routePluginManager = null;

    /**
     * RouteInterface to match.
     *
     * @var string
     */
    protected $route;

    /**
     * Default values.
     *
     * @var array
     */
    protected $defaults;

    /**
     * Create a new literal route.
     *
     */
    public function __construct()
    {
    }

    /**
     * factory(): defined by RouteInterface interface.
     *
     * @see    \Zend\Mvc\Router\RouteInterface::factory()
     *
     * @param array $options
     *
     * @return void|static
     */
    public static function factory($options = array())
    {
        return new static();
    }

    /**
     * Match a given request.
     *
     * @param Request $request
     * @param null    $pathOffset
     *
     * @return null|void|\Zend\Mvc\Router\RouteMatch
     */
    public function match(Request $request, $pathOffset = null)
    {
        if (!method_exists($request, 'getUri')) {
            return null;
        }

        $uri  = $request->getUri();
        $path = $uri->getPath();

        $serviceLocator = $this->routePluginManager->getServiceLocator();

        /** @var \UrlRewrite\Service\UrlRewriteService $urlRewriteService */
        $urlRewriteService = $serviceLocator->get('UrlRewrite\Service\UrlRewriteService');

        $matchedRoute = $urlRewriteService->getRouteFromPath($path);
        if (!$matchedRoute) {
            return null;
        }

        // return a \Zend\Mvc\Router\RouteMatch instance
        return new RouteMatch($matchedRoute, strlen($this->route));
    }

    /**
     * Assemble the route.
     *
     * @param array $params
     * @param array $options
     *
     * @return mixed|string
     */
    public function assemble(array $params = array(), array $options = array())
    {
        // assemble the route and return the URL as string
        return $this->route;
    }

    /**
     * Get a list of parameters used while assembling.
     */
    public function getAssembledParams()
    {
        return array();
    }

    /**
     * Set service locator
     *
     * @param ServiceLocatorInterface $routePluginManager
     */
    public function setServiceLocator(ServiceLocatorInterface $routePluginManager)
    {
        $this->routePluginManager = $routePluginManager;
    }

    /**
     * Get service locator
     *
     * @return ServiceLocatorInterface
     */
    public function getServiceLocator()
    {
        return $this->routePluginManager;
    }
}