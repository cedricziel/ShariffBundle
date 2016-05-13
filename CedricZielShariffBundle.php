<?php

namespace CedricZiel\ShariffBundle;

use CedricZiel\ShariffBundle\DependencyInjection\CedricZielShariffExtension;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * @package CedricZiel\ShariffBundle
 */
class CedricZielShariffBundle extends Bundle
{
    /**
     * @return string
     */
    public function getContainerExtensionClass()
    {
        return CedricZielShariffExtension::class;
    }
}
