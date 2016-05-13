<?php

namespace CedricZiel\ShariffBundle\Twig;

use CedricZiel\ShariffBundle\Model\ShariffConfig;

/**
 * @package CedricZiel\ShariffBundle\Twig
 */
class ShariffExtension extends \Twig_Extension implements \Twig_Extension_GlobalsInterface
{
    /**
     * @var ShariffConfig
     */
    protected $shariffConfig;

    /**
     * @param ShariffConfig $shariffConfig
     */
    public function __construct(ShariffConfig $shariffConfig)
    {
        $this->shariffConfig = $shariffConfig;
    }

    /**
     * @return array
     */
    public function getGlobals()
    {
        return ['shariffConfig' => $this->shariffConfig];
    }

    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return 'shariff';
    }
}
