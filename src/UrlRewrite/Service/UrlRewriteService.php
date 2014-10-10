<?php

namespace UrlRewrite\Service;

use \UrlRewrite\Entity;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\EventManager;
use Zend\EventManager\EventManagerAwareInterface;


/**
 * Handles interaction with events (IE conferences)
 *
 * @author m4s0
 *
 */
class UrlRewriteService
    implements EventManagerAwareInterface
{
    private $eventManager;

    private $entityManager;

    /** @var \UrlRewrite\Entity\UrlRewrite */
    private $UrlRewriteRepository;

    public function __construct(\Doctrine\ORM\EntityManager $entityManager)
    {
        $this->entityManager        = $entityManager;
        $this->UrlRewriteRepository = $entityManager->getRepository('UrlRewrite\Entity\UrlRewrite');
    }

    public function getRouteFromPath($requestPath)
    {
        try {
            /** @var \UrlRewrite\Entity\UrlRewrite $route */
            $route = $this->UrlRewriteRepository->findOneBy(array('RewriteUrl' => $requestPath));

            if (null == $route) {
                return null;
                //            throw new \DomainException('No Route with such Path here.');
            }

            return $route->getRouteMatch();
        } catch (\Exception $e) {
            return null;
        }
    }

    public function setRouteMatch($rewriteUrl, $requestUri, $matchedRouteName, \Zend\Mvc\Router\Http\RouteMatch $routeMatch)
    {
        try {
            $UrlRewrite = new Entity\UrlRewrite();
            $UrlRewrite->setRewriteUrl($rewriteUrl);
            $UrlRewrite->setRequestUri($requestUri);
            $UrlRewrite->setMatchedRouteName($matchedRouteName);
            $UrlRewrite->setRouteMatch($routeMatch->getParams());
            $this->saveUrlRewrite($UrlRewrite);

            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function saveUrlRewrite(\UrlRewrite\Entity\UrlRewrite $UrlRewrite)
    {
        $this->entityManager->persist($UrlRewrite);
        $this->entityManager->flush();
    }

    /**
     * Injects Event Manager (ZF2 component) into this class
     *
     * @see \Zend\EventManager\EventManagerAwareInterface::setEventManager()
     */
    public function setEventManager(EventManagerInterface $events)
    {
        $events->setIdentifiers(
            array(
                __CLASS__,
                get_called_class(),
            )
        );
        $this->eventManager = $events;

        return $this;
    }

    /**
     * Fetches Event Manager (ZF2 component) from this class
     *
     * @see \Zend\EventManager\UrlRewriteCapableInterface::getEventManager()
     */
    public function getEventManager()
    {
        if (null === $this->eventManager) {
            $this->setEventManager(new EventManager());
        }

        return $this->eventManager;
    }
}