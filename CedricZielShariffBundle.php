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

    /**
     * {@inheritdoc}
     */
    public function getContainerExtension()
    {
        if (null === $this->extension) {
            return $this->extension = $this->createContainerExtension();
        }

        return $this->extension;
    }
}
