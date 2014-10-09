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

    protected $routePluginManager = null;

    /**
     * Create a new Custom route.
     *
     * @param  string $regex
     * @param  string $spec
     * @param  array  $defaults
     */
    public function __construct($regex, $spec, array $defaults = array())
    {
        $this->defaults = $defaults;
        $this->regex    = $regex;
        $this->spec     = $spec;
    }
    //    public function __construct($route, array $defaults = array())
    //    {
    //        $this->route    = $route;
    //        $this->defaults = $defaults;
    //    }

    /**
     * Create a new route with given options.
     *
     * @param array $options
     *
     * @return void|static
     */
    public static function factory($options = array())
    {
        if ($options instanceof \Traversable) {
            $options = ArrayUtils::iteratorToArray($options);
        }
        elseif (!is_array($options)) {
            throw new \InvalidArgumentException(__METHOD__ . ' expects an array or Traversable set of options');
        }

        if (!isset($options['regex'])) {
            throw new \InvalidArgumentException('Missing "regex" in options array');
        }

        if (!isset($options['spec'])) {
            throw new \InvalidArgumentException('Missing "spec" in options array');
        }

        if (!isset($options['defaults'])) {
            $options['defaults'] = array();
        }

        return new static($options['regex'], $options['spec'], $options['defaults']);
    }
    //    public static function factory($options = array())
    //    {
    //        if ($options instanceof \Traversable) {
    //            $options = ArrayUtils::iteratorToArray($options);
    //        }
    //        elseif (!is_array($options)) {
    //            throw new InvalidArgumentException(
    //                __METHOD__ . ' expects an array or Traversable set of options'
    //            );
    //        }
    //
    //        if (!isset($options['route'])) {
    //            throw new InvalidArgumentException('Missing "route" in options array');
    //        }
    //
    //        if (!isset($options['defaults'])) {
    //            $options['defaults'] = array();
    //        }
    //
    //        return new static($options['route'], $options['defaults']);
    //    }


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
//        return new RouteMatch($matchedRoute, strlen($this->route));
        return new RouteMatch($this->defaults, strlen($this->route));
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