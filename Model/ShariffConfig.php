<?php

namespace CedricZiel\ShariffBundle\Model;

/**
 * Configures the shariff backend
 *
 * @package CedricZiel\ShariffBundle
 */
class ShariffConfig
{
    /**
     * @var string
     */
    protected $domain;

    /**
     * @var string
     */
    protected $forceProtocol;

    /**
     * @var string
     */
    protected $cacheDir;

    /**
     * @var int
     */
    protected $cacheTtl;

    /**
     * @var array
     */
    protected $services;

    /**
     * @var array
     */
    protected $serviceConfig = [];

    /**
     * @var string
     */
    protected $adapter;

    /**
     * @var array
     */
    protected $adapterOptions;

    /**
     * @var array
     */
    protected $client;

    /**
     * @param string $domain
     * @param string $forceProtocol
     * @param array  $services
     * @param array  $cache
     * @param array  $client
     */
    public function __construct($domain, $forceProtocol, $services, $cache, $client)
    {
        $this->domain = $domain;
        $this->forceProtocol = $forceProtocol;
        $this->services = array_keys($services);
        $this->cacheTtl = $cache['ttl'];
        $this->cacheDir = isset($cache['cacheDir']) ? $cache['cacheDir'] : null;
        $this->adapter = isset($cache['adapter']) ? $cache['adapter'] : null;
        $this->adapterOptions = isset($cache['adapterOptions']) ? $cache['adapterOptions'] : null;

        foreach ($services as $name => $serviceConfig) {
            if (null !== $serviceConfig) {
                $this->serviceConfig[$name] = $serviceConfig;
            }
        }
        $this->client = $client;
    }

    /**
     * @return string
     */
    public function getCacheDir()
    {
        return $this->cacheDir;
    }

    /**
     * @param string $cacheDir
     */
    public function setCacheDir($cacheDir)
    {
        $this->cacheDir = $cacheDir;
    }

    /**
     * @return int
     */
    public function getCacheTtl()
    {
        return $this->cacheTtl;
    }

    /**
     * @param int $cacheTtl
     */
    public function setCacheTtl($cacheTtl)
    {
        $this->cacheTtl = $cacheTtl;
    }

    /**
     * @return string
     */
    public function getDomain()
    {
        return $this->domain;
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
    public function getForceProtocol()
    {
        return $this->forceProtocol;
    }

    /**
     * @param string $forceProtocol
     */
    public function setForceProtocol($forceProtocol)
    {
        $this->forceProtocol = $forceProtocol;
    }

    /**
     * @return array
     */
    public function getServices()
    {
        return $this->services;
    }

    /**
     * @param array $services
     */
    public function setServices($services)
    {
        $this->services = $services;
    }

    /**
     * @return string
     */
    public function getAdapter()
    {
        return $this->adapter;
    }

    /**
     * @param string $adapter
     */
    public function setAdapter($adapter)
    {
        $this->adapter = $adapter;
    }

    /**
     * @return array
     */
    public function getAdapterOptions()
    {
        return $this->adapterOptions;
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
    public function toArray()
    {
        $result = [];
        $result['domains'][] = $this->domain;
        $result['force_protocol'] = $this->forceProtocol;
        $result['services'] = $this->services;
        $result = array_merge($result, $this->serviceConfig);

        $result['services'] = array_filter(
            $result['services'],
            function ($v) {
                return 'Twitter' != $v && 'Mail' != $v;
            }
        );

        $result['cache'] = ['ttl' => $this->cacheTtl];
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
