<?php

namespace CedricZiel\ShariffBundle;

/**
 * Configures the shariff backend
 *
 * @package CedricZiel\ShariffBundle
 */
class ShariffConfig
{
    /** @var string */
    protected $domain;

    /** @var string */
    protected $force_protocol;

    /** @var string */
    protected $cacheDir;

    /** @var int */
    protected $cacheTtl;

    /** @var array */
    protected $services;

    /** @var array */
    protected $serviceConfig = array();

    /** @var string */
    protected $adapter;

    /** @var array */
    protected $adapterOptions;

    /** @var array */
    protected $client;

    public function __construct($domain, $force_protocol, $services, $cache, $client)
    {
        $this->domain = $domain;
        $this->force_protocol = $force_protocol;
        $this->services = array_keys($services);
        $this->cacheTtl = $cache['ttl'];
        $this->cacheDir = isset($cache['cacheDir']) ? $cache['cacheDir'] : null;
        $this->adapter = isset($cache['adapter']) ? $cache['adapter'] : null;
        $this->adapterOptions = isset($cache['adapterOptions']) ? $cache['adapterOptions'] : null;

        foreach($services as $name => $serviceConfig) {
            if (null !== $serviceConfig) {
                $this->serviceConfig[$name] = $serviceConfig;
            }
        }
        $this->client = $client;
    }


    /**
     * @param string $cacheDir
     */
    public function setCacheDir($cacheDir)
    {
        $this->cacheDir = $cacheDir;
    }

    /**
     * @return string
     */
    public function getCacheDir()
    {
        return $this->cacheDir;
    }

    /**
     * @param int $cacheTtl
     */
    public function setCacheTtl($cacheTtl)
    {
        $this->cacheTtl = $cacheTtl;
    }

    /**
     * @return int
     */
    public function getCacheTtl()
    {
        return $this->cacheTtl;
    }

    /**
     * @param string $domain
     */
    public function setDomain($domain)
    {
        $this->domain = $domain;
    }

    /**
     * @return string
     */
    public function getDomain()
    {
        return $this->domain;
    }

    /**
     * @return string
     */
    public function getForceProtocol()
    {
        return $this->force_protocol;
    }

    /**
     * @param string $force_protocol
     */
    public function setForceProtocol($force_protocol)
    {
        $this->force_protocol = $force_protocol;
    }

    /**
     * @param array $services
     */
    public function setServices($services)
    {
        $this->services = $services;
    }

    /**
     * @return array
     */
    public function getServices()
    {
        return $this->services;
    }

    /**
     * @param string $adapter
     */
    public function setAdapter($adapter)
    {
        $this->adapter = $adapter;
    }

    /**
     * @return string
     */
    public function getAdapter()
    {
        return $this->adapter;
    }

    /**
     * @param array $adapterOptions
     */
    public function setAdapterOptions($adapterOptions)
    {
        $this->adapterOptions = $adapterOptions;
    }

    /**
     * @return array
     */
    public function getAdapterOptions()
    {
        return $this->adapterOptions;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $result = array();
        $result['domain'] = $this->domain;
        $result['force_protocol'] = $this->force_protocol;
        $result['services'] = $this->services;
        $result = array_merge($result, $this->serviceConfig);

        $result['services'] = array_filter($result['services'], function ($v) {
            return 'Twitter' != $v;
        });

        $result['cache'] = array('ttl' => $this->cacheTtl);
        if (null !== $this->cacheDir) {
            $result['cache']['cacheDir'] = $this->cacheDir;
        }
        if (null !== $this->adapter) {
            $result['cache']['adapter'] = $this->adapter;
        }
        if (null !== $this->adapterOptions) {
            $result['cache']['adapterOptions'] = $this->adapterOptions;
        }

        if (null !== $this->client && count($this->client)) {
            $result['client'] = $this->client;
        }

        return $result;
    }
}
