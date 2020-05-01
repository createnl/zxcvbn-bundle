<?php
declare(strict_types=1);

namespace Createnl\ZxcvbnBundle;

use ZxcvbnPhp\Zxcvbn;

interface ZxcvbnFactoryInterface
{
    public function createZxcvbn(): Zxcvbn;
}
