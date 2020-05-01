<?php
declare(strict_types=1);

namespace Createnl\ZxcvbnBundle;

use Createnl\ZxcvbnBundle\DependencyInjection\ZxcvbnBundleExtension;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class ZxcvbnBundle extends Bundle
{
    public function getContainerExtension()
    {
        return new ZxcvbnBundleExtension();
    }
}
