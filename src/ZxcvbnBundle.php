<?php
declare(strict_types=1);

namespace Createnl\ZxcvbnBundle;

use Createnl\ZxcvbnBundle\DependencyInjection\ZxcvbnBundleExtension;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\Extension\ExtensionInterface;

class ZxcvbnBundle extends Bundle
{
    public function getContainerExtension(): ExtensionInterface
    {
        return new ZxcvbnBundleExtension();
    }
}
