<?php

namespace Createnl\ZxcvbnBundle\Tests;

use Createnl\ZxcvbnBundle\DependencyInjection\ZxcvbnBundleExtension;
use Createnl\ZxcvbnBundle\ZxcvbnBundle;
use PHPUnit\Framework\TestCase;

class ZxcvbnBundleTest extends TestCase
{
    public function testGetContainerExtension(): void
    {
        $subject = new ZxcvbnBundle();

        $result = $subject->getContainerExtension();

        $this->assertInstanceOf(ZxcvbnBundleExtension::class, $result);
    }
}
