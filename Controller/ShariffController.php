<?php

namespace CedricZiel\ShariffBundle\Controller;


use CedricZiel\ShariffBundle\Model\ShariffConfig;
use CedricZiel\ShariffBundle\Service\ShariffServiceInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * @package CedricZiel\ShariffBundle\Controller
 */
class ShariffController
{
    /**
     * @var  ShariffServiceInterface
     */
    protected $shariffService;

    /**
     * @var ShariffConfig
     */
    protected $config;

    /**
     * @var  ViewHandlerInterface
     */
    protected $viewHandler;

    /**
     * ShariffController constructor.
     *
     * @param ShariffServiceInterface $shariffService
     * @param ShariffConfig           $config
     * @param ViewHandlerInterface    $viewHandler
     */
    public function __construct(
        ShariffServiceInterface $shariffService,
        ShariffConfig $config,
        ViewHandlerInterface $viewHandler
    ) {
        $this->shariffService = $shariffService;
        $this->viewHandler = $viewHandler;
        $this->config = $config;
    }

    /**
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getAction(Request $request)
    {
        $url = $request->query->get('url');
        $forceProtocol = $this->config->getForceProtocol();

        if (!is_null($forceProtocol)) {
            if ($forceProtocol === "https") {
                $url = str_replace('http://', 'https://', $url);
            }
            if ($forceProtocol === "http") {
                $url = str_replace('https://', 'http://', $url);
            }
        }

        $result = $this->shariffService->get($url);

        return new JsonResponse($result);
    }
}
