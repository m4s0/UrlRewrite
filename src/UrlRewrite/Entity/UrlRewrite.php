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
     * @ORM\Column(name="RewriteUrl", type="string", length=255, nullable=false)
     */
    private $RewriteUrl;

    /**
     * @var string
     *
     * @ORM\Column(name="requestUri", type="string", length=255, nullable=false)
     */
    private $requestUri;

    /**
     * @var string
     *
     * @ORM\Column(name="matchedRouteName", type="string", length=255, nullable=false)
     */
    private $matchedRouteName;

    /**
     * @var array
     *
     * @ORM\Column(name="RouteMatch", type="array", length=255, nullable=false)
     */
    private $RouteMatch;

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
     * Set RewriteUrl
     *
     * @param string $rewriteUrl
     * @return UrlRewrite
     */
    public function setRewriteUrl($rewriteUrl)
    {
        $this->RewriteUrl = $rewriteUrl;

        return $this;
    }

    /**
     * Get RewriteUrl
     *
     * @return string 
     */
    public function getRewriteUrl()
    {
        return $this->RewriteUrl;
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
     * Set matchedRouteName
     *
     * @param string $matchedRouteName
     * @return UrlRewrite
     */
    public function setMatchedRouteName($matchedRouteName)
    {
        $this->matchedRouteName = $matchedRouteName;

        return $this;
    }

    /**
     * Get matchedRouteName
     *
     * @return string 
     */
    public function getMatchedRouteName()
    {
        return $this->matchedRouteName;
    }

    /**
     * Set RouteMatch
     *
     * @param array $routeMatch
     * @return UrlRewrite
     */
    public function setRouteMatch($routeMatch)
    {
        $this->RouteMatch = $routeMatch;

        return $this;
    }

    /**
     * Get RouteMatch
     *
     * @return array 
     */
    public function getRouteMatch()
    {
        return $this->RouteMatch;
    }
}
