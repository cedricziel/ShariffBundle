<?php

namespace CedricZiel\ShariffBundle\Service;

use CedricZiel\ShariffBundle\Model\ShariffConfig;
use GuzzleHttp\Exception\GuzzleException;
use Heise\Shariff\Backend;

/**
 * @package CedricZiel\ShariffBundle\Service
 */
class ShariffService implements ShariffServiceInterface
{
    /**
     * @var ShariffConfig
     */
    protected $config;

    /**
     * @param ShariffConfig $config
     */
    public function __construct(ShariffConfig $config)
    {
        $this->config = $config;
    }

    /**
     * Get the information from the backend for the given url
     *
     * @param string $url
     *
     * @return array
     */
    public function get($url)
    {
        $backend = new Backend($this->config->toArray());

        try {
            return $backend->get($url);
        } catch (GuzzleException $e) {
            return [$e];
        }
    }
}
