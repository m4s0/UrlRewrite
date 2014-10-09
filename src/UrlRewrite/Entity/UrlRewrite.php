<?php

namespace UrlRewrite\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * UrlRewrite
 *
 * @ORM\Table(name="UrlRewrite", uniqueConstraints={@ORM\UniqueConstraint(name="type_UNIQUE", columns={"id"})})
 * @ORM\Entity
 */
class UrlRewrite
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="requestUri", type="string", length=255, nullable=false)
     */
    private $requestUri;

    /**
     * @var string
     *
     * @ORM\Column(name="route", type="string", length=255, nullable=false)
     */
    private $route;

    /**
     * @var array
     *
     * @ORM\Column(name="routeMatch", type="array", length=255, nullable=true)
     */
    private $routeMatch;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set requestUri
     *
     * @param string $requestUri
     * @return UrlRewrite
     */
    public function setRequestUri($requestUri)
    {
        $this->requestUri = $requestUri;

        return $this;
    }

    /**
     * Get requestUri
     *
     * @return string 
     */
    public function getRequestUri()
    {
        return $this->requestUri;
    }

    /**
     * Set route
     *
     * @param string $route
     * @return UrlRewrite
     */
    public function setRoute($route)
    {
        $this->route = $route;

        return $this;
    }

    /**
     * Get route
     *
     * @return string 
     */
    public function getRoute()
    {
        return $this->route;
    }

    /**
     * Set routeMatch
     *
     * @param array $routeMatch
     * @return UrlRewrite
     */
    public function setRouteMatch($routeMatch)
    {
        $this->routeMatch = $routeMatch;

        return $this;
    }

    /**
     * Get routeMatch
     *
     * @return array
     */
    public function getRouteMatch()
    {
        return $this->routeMatch;
    }
}
