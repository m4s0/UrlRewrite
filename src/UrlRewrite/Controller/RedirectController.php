<?php


namespace UrlRewrite\Controller;

use UrlRewrite\Service\UrlRewriteService;
use Zend\Mvc\Controller\AbstractActionController;


class RedirectController
    extends AbstractActionController
{
    /** @var UrlRewriteService UrlRewriteService */
    private $urlRewriteService;

    /**
     * Class constructor
     *
     * @param UrlRewriteService $urlRewriteService
     */
    public function __construct(UrlRewriteService $urlRewriteService)
    {
        $this->urlRewriteService = $urlRewriteService;
    }

    public function redirectAction()
    {
        return $this->redirect()->toRoute($route, $params);
    }
}