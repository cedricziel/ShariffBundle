<?php

namespace CedricZiel\ShariffBundle\Service;

/**
 * @package CedricZiel\ShariffBundle\Service
 */
interface ShariffServiceInterface
{
    /**
     * Get the information from the backend for the given url
     *
     * @param string $url
     *
     * @return array
     */
    public function get($url);
}
